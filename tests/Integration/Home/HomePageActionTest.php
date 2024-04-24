<?php

namespace App\Test\Integration\Home;

use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Slim\Exception\HttpNotFoundException;
use TestTraits\Trait\HttpTestTrait;
use TestTraits\Trait\RouteTestTrait;

class HomePageActionTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;
    use RouteTestTrait;

    /**
     * Test that home page loads with status 200 OK.
     *
     * @return void
     */
    public function testHomePageAction(): void
    {
        $request = $this->createRequest('GET', $this->urlFor('home-page'));

        $response = $this->app->handle($request);

        // Assert 200 OK
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }

    /**
     * Test that url /home redirects to / and loads with status 200 OK.
     *
     * @return void
     */
    public function testHomePageRedirectAction(): void
    {
        $request = $this->createRequest('GET', '/home');

        $response = $this->app->handle($request);

        // Assert 302 Found (redirect)
        self::assertSame(StatusCodeInterface::STATUS_FOUND, $response->getStatusCode());

        // Assert that Location header is set to /
        self::assertSame('/', $response->getHeaderLine('Location'));
    }

    /**
     * Test that HTTP not found exception is thrown when the URL is invalid.
     *
     * @return void
     */
    public function testHomePageActionNotFound(): void
    {
        $request = $this->createRequest('GET', 'invalid');

        $this->expectException(HttpNotFoundException::class);

        $this->app->handle($request);
    }
}
