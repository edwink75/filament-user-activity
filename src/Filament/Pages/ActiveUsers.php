<?php

namespace Edwink\FilamentUserActivity\Filament\Pages;

use Filament\Pages\Page;

class ActiveUsers extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static string $view = 'filament-user-activity::pages.active-users';

    public static function getNavigationLabel(): string
    {
        return __('filament-user-activity::user-activity.currently-active-users');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-user-activity::user-activity.resource.navigation');
    }
}
