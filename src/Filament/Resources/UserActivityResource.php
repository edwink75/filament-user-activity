<?php

namespace Edwink\FilamentUserActivity\Filament\Resources;


use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;

use Edwink\FilamentUserActivity\Models\UserActivity;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class UserActivityResource extends Resource
{

    protected static ?string $model = UserActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function isScopedToTenant(): bool
    {
        return config('filament-user-activity.is_tenant_aware') ?? static::$isScopedToTenant;
    }

    public static function getTenantOwnershipRelationshipName(): string
    {
        return config('filament-user-activity.tenant_ownership_relationship_name') ?? Filament::getTenantOwnershipRelationshipName();
    }

    public static function getModelLabel(): string
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getLabel();
    }

    public static function getPluralModelLabel(): string
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getPluralLabel();
    }

    public static function getNavigationLabel(): string
    {
        return Str::title(static::getPluralModelLabel()) ?? Str::title(static::getModelLabel());
    }

    public static function getNavigationIcon(): string
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getNavigationIcon();
    }

    public static function getNavigationSort(): ?int
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getNavigationSort();
    }

    public static function getNavigationGroup(): ?string
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationBadge(): ?string
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->getNavigationCountBadge() ?
            (Filament::hasTenancy() && Config::get('filament-user-activity.is_tenant_aware')) ?
                static::getEloquentQuery()
                    ->where(Config::get('filament-user-activity.tenant_ownership_relationship_name') . '_id', Filament::getTenant()->id)
                    ->count()
                : number_format(static::getModel()::count())
            : null;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return \Edwink\FilamentUserActivity\FilamentUserActivityPlugin::get()->shouldRegisterNavigation();
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
