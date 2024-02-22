<?php

namespace Edwink\FilamentUserActivity\Filament\Resources;

use App\Models\User;
use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource\Pages;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserActivityResource extends Resource
{
    protected static ?string $model = UserActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('url'),
                Select::make('user_id')
                    ->options(User::pluck('name', 'id')),
            ])->disabled();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('url'),
                TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
