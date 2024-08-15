<?php

namespace App\Application\Middleware;

use App\Infrastructure\Utility\JsImportCacheBuster;
use App\Infrastructure\Utility\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Interfaces\RouteParserInterface;
use Slim\Routing\RouteContext;
use Slim\Views\PhpRenderer;

/**
 * Adds attributes to the PhpRenderer and updates js imports with version number.
 * Documentation: https://samuel-gfeller.ch/docs/Template-Rendering.
 */
final class PhpViewMiddleware implements MiddlewareInterface
{
    /** @var array<string, mixed> */
    private array $publicSettings;
    /** @var array<string, mixed> */
    private array $deploymentSettings;

    public function __construct(
        private readonly App $app,
        private readonly PhpRenderer $phpRenderer,
        private readonly JsImportCacheBuster $jsImportCacheBuster,
        Settings $settings,
        private readonly RouteParserInterface $routeParser
    ) {
        $this->publicSettings = $settings->get('public');
        $this->deploymentSettings = $settings->get('deployment');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // The following has to work even with no connection to mysql to display the error page (layout needs those attr)
        $this->phpRenderer->setAttributes([
            'version' => $this->deploymentSettings['version'],
            'uri' => $request->getUri(),
            'basePath' => $this->app->getBasePath(),
            'route' => $this->routeParser,
            'currRouteName' => RouteContext::fromRequest($request)->getRoute()?->getName(),
            // Used for public values (e.g. app name) used by templates or layout
            'config' => $this->publicSettings,
        ]);

        // Add version number to js imports in development mode
        // https://samuel-gfeller.ch/docs/Template-Rendering#js-import-cache-busting
        if ($this->deploymentSettings['update_js_imports_version'] === true) {
            $this->jsImportCacheBuster->addVersionToJsImports();
        }

        return $handler->handle($request);
    }
}
