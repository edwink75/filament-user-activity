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

    public static function canAccess(): bool
    {
        // default mode is to allow access unless some level of security is applied
        if(!config('filament-user-activity.access_control.enabled')) {
            return true;
        }

        /*
         * Access Control is enabled so now return false unless the user is allowed
         */
        if(config('filament-user-activity.access_control.spatie.enabled')) {
            if(auth()->user()?->hasPermissionTo(config('filament-user-activity.access_control.spatie.permission'))) {
                return true;
            }
        }


        if(in_array(auth()->user()?->email, config('filament-user-activity.access_control.allowed.emails'))) {
            return true;
        }

        if(in_array(auth()->user()?->id, config('filament-user-activity.access_control.allowed.user_ids'))) {
            return true;
        }

        return false;
    }
    
    public static function getModelLabel(): string
    {
        return __('filament-user-activity::user-activity.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-user-activity::user-activity.resource.model_plural_label');
    }

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
