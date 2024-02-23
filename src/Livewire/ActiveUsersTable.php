<?php

namespace Edwink\FilamentUserActivity\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Livewire\Attributes\Url;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ActiveUsersTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    #[Url]
    public int $minutes = 30;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("minutes")
                    ->options([
                        30 => "30 Minutes",
                        60 => "One hour",
                        120 => "2 Hours",
                        1440 => "24 hours"
                    ])
                    ->label("Active in last ")
                    ->reactive()
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::whereHas("activities", function ($query) {
                    $query->where("created_at", ">", Carbon::now()->subMinutes($this->minutes)->format("Y-m-d H:i:s"));
                })
                    ->with("activities", function ($query) {
                        $query->where("created_at", ">", Carbon::now()->subMinutes($this->minutes)->format("Y-m-d H:i:s"));
                    })
            )
            ->columns([
                // TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('activities.created_at')
                    ->formatStateUsing(function ($state) {
                        return max(explode(", ", $state));
                    })->label("Last action"),
                TextColumn::make('activities.url')
                    ->formatStateUsing(function ($state) {
                        return count(explode(", ",$state));
                    })->label("Last action"),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ])
            ->paginationPageOptions([50, 100]);;
    }

    public function render()
    {
        return view('filament-user-activity::livewire.active-users-table');
    }
}
