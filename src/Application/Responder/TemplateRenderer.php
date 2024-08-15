<?php

namespace App\Application\Responder;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

/**
 * Template renderer.
 * Documentation: https://samuel-gfeller.ch/docs/Template-Rendering.
 */
final readonly class TemplateRenderer
{
    public function __construct(private PhpRenderer $phpRenderer)
    {
    }

    /**
     * Render template.
     *
     * @param ResponseInterface $response The response
     * @param string $template Template pathname relative to templates directory
     * @param array<string, mixed> $data Associative array of template variables
     *
     * @return ResponseInterface The response
     */
    public function render(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        return $this->phpRenderer->render($response, $template, $data);
    }
}
