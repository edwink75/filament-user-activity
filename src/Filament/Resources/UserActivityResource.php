<?php

namespace Edwink\FilamentUserActivity\Filament\Resources;

use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                    ->options(config('filament-user-activity.model')::whereHas('activities')->pluck('name', 'id')),
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
