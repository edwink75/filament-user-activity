<?php

// config for Edwink/FilamentUserActivity
return [
    'model' => \App\Models\User::class,
    'resources'=>[
        'label' => 'User Activity',
        'plural_label' => 'User Activities',
        'navigation_group' => null,
        'navigation_icon' => 'heroicon-o-photo',
        'navigation_sort' => null,
        'navigation_count_badge' => false,
        'should_register_navigation' => true,
        'resource'=>\Edwink\FilamentUserActivity\Filament\Resources\UserActivityResource::class,
    ],
    'is_tenant_aware'=>false,
    'tenant_ownership_relationship_name'=>"tenant",
    'table' => [
        'name' => env('FILAMENT_USER_ACTIVITY_TABLE_NAME', 'user_activities'),
        'retention-days' => env('FILAMENT_USER_ACTIVITY_RETENTION_DAYS', 60),
        'active-users' => [
            'timeframe-selection' => [
                15 => '15 Minutes',
                30 => '30 Minutes',
                60 => 'One hour',
                120 => '2 Hours',
                1440 => '24 hours',
            ],
        ],
    ],
];
