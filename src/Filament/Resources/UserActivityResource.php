<?php

namespace Edwink\FilamentUserActivity\Filament\Resources;

use Stringable;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;

class UserActivityResource extends Resource
{
    protected static ?string $model = UserActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('filament-user-activity::user-activity.resource.navigation');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('filament-user-activity::user-activity.activity-table.column.time')),
                TextColumn::make('url')
                    ->sortable()
                    ->label(__('filament-user-activity::user-activity.activity-table.column.url')),
                TextColumn::make('user.name')
                    ->sortable()
                    ->label(__('filament-user-activity::user-activity.activity-table.column.user')),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->options(User::whereHas('activities')->pluck('name', 'id')),
            ])
            ->actions([])
            ->bulkActions([
                //
            ])
            ->paginationPageOptions([50, 100, 250])
            ->defaultSort('created_at', 'DESC');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserActivities::route('/'),
            'create' => Pages\CreateUserActivity::route('/create'),
            'edit' => Pages\EditUserActivity::route('/{record}/edit'),
        ];
    }
}
