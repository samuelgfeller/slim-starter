<?php

/**
 * Dependency Injection container configuration.
 *
 * Documentation: https://samuel-gfeller.ch/docs/Dependency-Injection.
 */

use App\Application\Middleware\PhpViewMiddleware;
use App\Infrastructure\Settings\Settings;
use Cake\Database\Connection;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Log\LoggerInterface;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\PhpRenderer;
use SlimErrorRenderer\Middleware\ExceptionHandlingMiddleware;
use SlimErrorRenderer\Middleware\NonFatalErrorHandlingMiddleware;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    // Create app instance
    App::class => function (ContainerInterface $container) {
        $app = AppFactory::createFromContainer($container);
        // Register routes
        (require __DIR__ . '/routes.php')($app);

        // Register middlewares
        (require __DIR__ . '/middleware.php')($app);

        return $app;
    },

    // HTTP factories
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    ServerRequestFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },

    // Required to create urls with urlFor
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },

    // Determine the base path in case the application is not running in the root directory
    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },

    // Logging: https://samuel-gfeller.ch/docs/Logging
    LoggerInterface::class => function (ContainerInterface $container) {
        $loggerSettings = $container->get('settings')['logger'];

        $logger = new Logger('app');

        // When testing, 'test' value is true which means the monolog test handler should be used
        if (isset($loggerSettings['test']) && $loggerSettings['test'] === true) {
            return $logger->pushHandler(new Monolog\Handler\TestHandler());
        }

        // Instantiate logger with rotating file handler
        $filename = sprintf('%s/app.log', $loggerSettings['path']);
        $level = $loggerSettings['level'];
        // With the RotatingFileHandler, a new log file is created every day
        $rotatingFileHandler = new RotatingFileHandler($filename, 0, $level, true, 0777);
        // The last "true" here tells monolog to remove empty []'s
        $rotatingFileHandler->setFormatter(new LineFormatter(null, 'Y-m-d H:i:s', false, true));

        return $logger->pushHandler($rotatingFileHandler);
    },

    // Error handling: https://samuel-gfeller.ch/docs/Error-Handling
    ExceptionHandlingMiddleware::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        return new ExceptionHandlingMiddleware(
            $container->get(ResponseFactoryInterface::class),
            $settings['error']['log_errors'] ? $container->get(LoggerInterface::class) : null,
            $settings['error']['display_error_details'],
            $settings['public']['main_contact_email'] ?? null
        );
    },

    // Add error middleware for notices and warnings
    NonFatalErrorHandlingMiddleware::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['error'];

        return new NonFatalErrorHandlingMiddleware(
            $settings['display_error_details'],
            $settings['log_errors'] ? $container->get(LoggerInterface::class) : null,
        );
    },

    // Establish database connection
    Connection::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['db'];

        return new Connection($settings);
    },
    // PDO instance is required for integration testing and schema.sql generation
    PDO::class => function (ContainerInterface $container) {
        $driver = $container->get(Connection::class)->getDriver();
        $class = new ReflectionClass($driver);
        $method = $class->getMethod('getPdo');
        // Make function getPdo() public
        $method->setAccessible(true);

        return $method->invoke($driver);
    },
    // Used by command line to generate `schema.sql` for integration testing
    // Documentation: https://samuel-gfeller.ch/docs/Test-Setup#generating-the-schema-file
    'SqlSchemaGenerator' => function (ContainerInterface $container) {
        return new TestTraits\Console\SqlSchemaGenerator(
            $container->get(PDO::class),
            // Schema output folder
            $container->get('settings')['root_dir'] . '/resources/schema'
        );
    },

    // Settings object that classes can inject to get access to the local configuration
    // Documentation: https://samuel-gfeller.ch/docs/Configuration#using-the-settings-class
    Settings::class => function (ContainerInterface $container) {
        return new Settings($container->get('settings'));
    },

    // Template renderer: https://samuel-gfeller.ch/docs/Template-Rendering
    PhpRenderer::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');
        $rendererSettings = $settings['renderer'];

        /** Global attributes are set in @see PhpViewMiddleware */
        return new PhpRenderer($rendererSettings['path']);
    },
];
