<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env(
                'AWS_USE_PATH_STYLE_ENDPOINT',
                false
            ),
            'throw' => false,
        ],

        'healthlink' => [
            'driver' => 'sftp',
            'host' => env('HEALTHLINK_SFTP_HOST'),

            // Settings for basic authentication...
            'username' => env('HEALTHLINK_SFTP_USERNAME'),
            'password' => env('HEALTHLINK_SFTP_PASSWORD'),
         
            // Settings for SSH key based authentication with encryption password...
            'privateKey' => env('HEALTHLINK_SFTP_PRIVATE_KEY'),
            'passphrase' => env('HEALTHLINK_SFTP_PASSPHRASE'),
         
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('images') => storage_path('app/images'),
        public_path('files') => storage_path('app/files'),
    ],

    /*
    |--------------------------------------------------------------------------
    | File paths
    |--------------------------------------------------------------------------
    |
    | Here we can configure the file and folder paths for different kinds of
    | files that will get uploaded by users.
    |
    */

    'filepaths' => [
        'referral'         => 'files/appointment_referral/',
        'pre_admission'    => 'files/appointment_pre_admission/',
        'patient_document' => 'files/patient_documents/',
    ],
];
