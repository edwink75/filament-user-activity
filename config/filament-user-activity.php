<?php

// config for Edwink/FilamentUserActivity
return [
    'model' => \App\Models\User::class,
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
    'access_control' => [
        'enabled' => env('FILAMENT_USER_ACTIVITY_ACCESS_CONTROL_ENABLED', false), // set to true to restrict access to the Resource
        'spatie' => [
            'enabled' => env('FILAMENT_USER_ACTIVITY_SPATIE_PERMISSIONS_ACTIVE', false),
            'permission' => env('FILAMENT_USER_ACTIVITY_SPATIE_PERMISSION', 'filament_user_activity.access'),
        ],
        'allowed' => [
            'emails' => array_map('trim', explode(',', env('FILAMENT_USER_ACTIVITY_ALLOWED_EMAILS', '')) ?? []), // string of comma-delimited emails e.g. 'user1@test.com,user2@test.com'
            'user_ids' => array_map('trim', explode(',', env('FILAMENT_USER_ACTIVITY_ALLOWED_USER_IDS', '')) ?? []), // string of comma delimited user ids e.g. '1,2,3'
        ],
    ],
];
