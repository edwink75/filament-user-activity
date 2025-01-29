<?php

namespace Edwink\FilamentUserActivity\Filament\Pages;

use Filament\Pages\Page;

class ActiveUsers extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static string $view = 'filament-user-activity::pages.active-users';

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
    
    public static function getNavigationLabel(): string
    {
        return __('filament-user-activity::user-activity.currently-active-users');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-user-activity::user-activity.resource.navigation');
    }
}
