<?php

namespace Edwink\FilamentUserActivity;

use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentUserActivityPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-user-activity';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                UserActivityResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
