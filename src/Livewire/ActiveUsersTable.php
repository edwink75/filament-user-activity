<?php

namespace Edwink\FilamentUserActivity\Livewire;

use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Attributes\Url;
use Livewire\Component;

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
                Select::make('minutes')
                    ->options(config('filament-user-activity.table.active-users.timeframe-selection'))
                    ->label('Active in last ')
                    ->reactive(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                config('filament-user-activity.model')::whereHas('activities', function ($query) {
                    $query->where('created_at', '>', Carbon::now()->subMinutes($this->minutes)->format('Y-m-d H:i:s'));
                })
                    ->with('activities', function ($query) {
                        $query->where('created_at', '>', Carbon::now()->subMinutes($this->minutes)->format('Y-m-d H:i:s'));
                    })
            )
            ->columns([
                // TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('activities.created_at')
                    ->formatStateUsing(function ($state) {
                        $timestamp = max(explode(', ', $state));

                        return Carbon::create($timestamp)->diffForHumans();
                    })->label(__('filament-user-activity::user-activity.active-users-table.column.last_action_time')),

                TextColumn::make('activities.url')
                    ->formatStateUsing(function ($state) {
                        return count(explode(', ', $state));
                    })->label(__('filament-user-activity::user-activity.active-users-table.column.last_action_count')),

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
            ->paginationPageOptions([50, 100]);
    }

    public function render()
    {
        return view('filament-user-activity::livewire.active-users-table');
    }
}
