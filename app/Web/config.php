<?php

/**
 * Application configuration settings.
 * 
 * This configuration file contains settings for debugging, directories,
 * API keys, database connections, and mail server configurations.
 */

return [
    // Debugging settings
    'debug' => true,

    // Directory paths
    'tmp_dir' => __DIR__ . '/../../temp', // Temporary files directory
    'lang_dir' => __DIR__ . '/../../i18n', // Language files directory
    'upload_dir' => __DIR__ . '/../../public/uploads', // Upload directory

    // URL settings
    'media_url' => '/uploads/', // Media URL
    'asset_url' => '/resources/', // Asset URL

    // Localization settings
    'lang' => 'en', // Default language

    // Security settings
    'app_key' => 'vHQBPufA2RSQYuk/ySGkBzQwrs6m1aM/NCdhx+DczhA=', // Application key, replace with a 32 characters long unique string

    // Database connection settings
    'database' => [
        'driver' => 'sqlite', // Database driver
        'file' => __DIR__ . '/../sqlite.db', // SQLite Database filepath 
    ],
];
