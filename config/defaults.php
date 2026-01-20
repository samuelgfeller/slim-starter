<?php

/**
 * Default configuration values.
 *
 * This file should contain all keys, even secret ones to serve as template.
 *
 * This is the first file loaded in settings.php and can safely define arrays
 * without the risk of overwriting something.
 * The only file where the following is permitted: $settings['db'] = ['key' => 'val', 'nextKey' => 'nextVal'];
 *
 * Documentation: https://samuel-gfeller.ch/docs/Configuration.
 */
// Set default locale
setlocale(LC_ALL, 'en_US.utf8', 'en_US');

// Init settings var
$settings = [];

// Project root dir (1 parent)
$settings['root_dir'] = dirname(__DIR__, 1);

$settings['deployment'] = [
    // Version string or null.
    // If JsImportCacheBuster is enabled, `null` removes all query param versions from js imports
    'version' => '4.0.1',
    // When true, JsImportCacheBuster is enabled and goes through all js files and changes the version number
    // from the imports. Should be disabled in env.prod.php.
    // https://samuel-gfeller.ch/docs/Template-Rendering#js-import-cache-busting
    'update_js_imports_version' => false,
    // Asset path required by the JsImportCacheBuster
    'asset_path' => $settings['root_dir'] . '/public/assets',
];

// Error handler: https://github.com/samuelgfeller/slim-error-renderer
$settings['error'] = [
    // MUST be set to false in production.
    // When set to true, it shows error details and throws an ErrorException for notices and warnings.
    'display_error_details' => false,
    'log_errors' => true,
];

$settings['public'] = [
    'app_name' => 'Slim Starter',
    'main_contact_email' => 'contact@samuel-gfeller.ch',
];

// Secret values are overwritten in env.php
// Query Builder: https://book.cakephp.org/5/en/orm/query-builder.html
// Documentation: https://samuel-gfeller.ch/docs/Repository-and-Query-Builder
$settings['db'] = [
    'host' => '127.0.0.1',
    'database' => 'slim_starter',
    'username' => 'root',
    'password' => '',
    'driver' => Cake\Database\Driver\Mysql::class,
    'encoding' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Disable query logging
    'log' => false,
    // Turn off persistent connections
    'persistent' => false,
    // PDO options
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

// API documentation: https://samuel-gfeller.ch/docs/API-Endpoint
$settings['api'] = [
    // Url that is allowed to make api calls to this app
    'allowed_origin' => null,
];

// Phinx database migration settings
// Documentation: https://samuel-gfeller.ch/docs/Database-Migrations
// Libraries: https://github.com/odan/phinx-migrations-generator, https://book.cakephp.org/phinx/0/en/index.html
$settings['phinx'] = [
    'paths' => [
        'migrations' => $settings['root_dir'] . '/resources/migrations',
        'seeds' => $settings['root_dir'] . '/resources/seeds',
    ],
    'schema_file' => $settings['root_dir'] . '/resources/schema/schema.php',
    'default_migration_prefix' => 'db_change_',
    'generate_migration_name' => true,
    'environments' => [
        // Table that keeps track of the migrations
        'default_migration_table' => 'phinx_migration_log',
        'default_environment' => 'local',
        'local' => [
            /* Environment specifics such as db credentials from the secret config are added in env.phinx.php */
        ],
    ],
];

// Template renderer settings
// Documentation: https://samuel-gfeller.ch/docs/Template-Rendering
$settings['renderer'] = [
    // Template path
    'path' => $settings['root_dir'] . '/templates',
];

// Logger: https://samuel-gfeller.ch/docs/Logging
$settings['logger'] = [
    // Log file location
    'path' => $settings['root_dir'] . '/logs',
    // Default log level
    'level' => Monolog\Level::Debug,
];

return $settings;
