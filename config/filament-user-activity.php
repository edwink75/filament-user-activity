<?php

// config for Edwink/FilamentUserActivity
return [
    'table' => [
        'name' => env('FILAMENT_USER_ACTIVITY_TABLE_NAME', 'user_activities'),
        'retention-days' => env('FILAMENT_USER_ACTIVITY_RETENTION_DAYS', 60),
    ],
];
