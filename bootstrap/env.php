<?php

/**
 * This file contains the environment settings for debugging, directories, API keys, database connections, and mail server configurations.
 * Each configuration key is associated with a value that can be used to customize the application.
 *
 * @return array
 *     An associative array of settings.
 */

$dirpath = fn(string $path): string => dir_path(dirname(__DIR__) . '/' . $path);

return [
    // Debugging settings
    'debug' => true,

    // Directory paths
    'storage_dir' => $dirpath('storage'), // Storage directory
    'cache_dir' => $dirpath('storage/cache'), // Cache files directory
    'upload_dir' => $dirpath('public/uploads'), // Upload directory
    'template_dir' => $dirpath('app/Templates'), // Template directory
    'lang_dir' => $dirpath('i18n'), // Language files directory

    // URL settings
    'media_url' => '/uploads/', // Media URL
    'asset_url' => '/resources/', // Asset URL

    // Localization settings
    'lang' => 'en', // Default language

    // Security settings
    'app_key' => '4c5d44fb54e7830cb7b7f455514e408124f9f9372f071a9eeba2797386767bc2', // Application key, replace with a 32 characters long unique string

    // Database connection settings
    'database' => [
        'driver' => 'sqlite', // Database driver
        'file' => $dirpath('storage/sqlite.db'), // SQLite Database filepath 
    ],
];
