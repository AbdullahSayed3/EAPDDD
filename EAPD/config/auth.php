<?php
return [
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'applicant' => [
            'driver' => 'sanctum',
            'provider' => 'applicants',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'applicants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Application::class,
        ],
    ],
];
