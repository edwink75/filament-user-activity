<?php

namespace Edwink\FilamentUserActivity;

use Edwink\FilamentUserActivity\Filament\Pages\ActiveUsers;
use Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class FilamentUserActivityPlugin implements Plugin
{

    use EvaluatesClosures;

    protected string | Closure | null $label = null;

    protected string | Closure | null $navigationGroup = null;

    protected ?string $navigationIcon = null;

    protected ?int $navigationSort = null;

    protected ?bool $navigationCountBadge = null;

    protected ?bool $shouldRegisterNavigation = null;

    protected string | Closure | null $pluralLabel = null;

    protected ?string $resource = null;

    public function getId(): string
    {
        return 'filament-user-activity';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                $this->getResource(),
            ])
            ->pages([
                ActiveUsers::class,
            ]);
    }

    public function getResource(): string
    {

        return $this->resource ?? config('filament-user-activity.resources.resource');
    }

    public function getLabel(): string
    {
        return $this->evaluate($this->label) ?? config('filament-user-activity.resources.label');
    }

    public function getPluralLabel(): string
    {
        return $this->evaluate($this->pluralLabel) ?? config('filament-user-activity.resources.plural_label');
    }

    public function getNavigationGroup(): ?string
    {
        return $this->evaluate($this->navigationGroup) ?? config('filament-user-activity.resources.navigation_group');
    }

    public function getNavigationIcon(): ?string
    {
        return $this->navigationIcon ?? config('filament-user-activity.resources.navigation_icon');
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort ?? config('filament-user-activity.resources.navigation_sort');
    }

    public function getNavigationCountBadge(): ?bool
    {
        return $this->navigationCountBadge ?? config('filament-user-activity.resources.navigation_count_badge');
    }

    public function shouldRegisterNavigation(): ?bool
    {
        return $this->shouldRegisterNavigation ?? config('filament-user-activity.resources.should_register_navigation');
    }

    public function navigationGroup(string | Closure | null $group = null): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function navigationIcon(string $icon): static
    {
        $this->navigationIcon = $icon;

        return $this;
    }

    public function navigationSort(int $order): static
    {
        $this->navigationSort = $order;

        return $this;
    }

    public function navigationCountBadge(bool $show = true): static
    {
        $this->navigationCountBadge = $show;

        return $this;
    }

    public function registerNavigation(bool $show = true): static
    {
        $this->shouldRegisterNavigation = $show;

        return $this;
    }

    public function pluralLabel(string | Closure $label): static
    {
        $this->pluralLabel = $label;

        return $this;
    }

    public function resource(string $resource): static
    {
        $this->resource = $resource;

        return $this;
    }

    public function label(string | Closure $label): static
    {
        $this->label = $label;

        return $this;
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
