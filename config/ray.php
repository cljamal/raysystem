<?php

use App\Ray\Modules\Base\Controllers\AuthController;


return [
    'basedir' => app_path('Ray'),
    'routes' => [
        'middleware' => ['ray'],
        'admin-prefix' => 'admin',
        'root-name' => 'ray',
    ],
    'admin' => [
        'template' => 'default',
        'login-logo' => asset('ray/img/logo.png')
    ],
    'auth' => [
        'controller' => AuthController::class,

        'guard' => 'ray',

        'guards' => [
            'ray' => [
                'driver'   => 'session',
                'provider' => 'ray',
            ],
        ],

        'providers' => [
            'ray' => [
                'driver' => 'eloquent',
                'model'  => CLJAMAL\RaySystem\Models\UserModel::class,
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'auth/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            '_handle_action_',
        ],
    ],
];
