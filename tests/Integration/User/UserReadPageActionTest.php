<?php

namespace App\Test\Integration\User;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Slim\Exception\HttpNotFoundException;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpTestTrait;
use TestTraits\Trait\RouteTestTrait;

class UserReadPageActionTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;
    use RouteTestTrait;
    use FixtureTestTrait;

    /**
     * Test that user read page loads with status 200 OK when user exists.
     *
     * @return void
     */
    public function testUserReadPageAction(): void
    {
        $userRow = $this->insertFixture(UserFixture::class);

        $request = $this->createRequest('GET', $this->urlFor('user-read-page', ['user_id' => $userRow['id']]));

        $response = $this->app->handle($request);

        // Assert 200 OK - code only reaches here if no exception is thrown
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }

    /**
     * Test that when the user does not exist, the HttpNotFoundException is thrown.
     *
     * @return void
     */
    public function testUserReadPageActionNotFound(): void
    {
        $request = $this->createRequest('GET', $this->urlFor('user-read-page', ['user_id' => '1']));

        // HttpNotFoundException must be thrown when a user doesn't exist
        $this->expectException(HttpNotFoundException::class);

        $this->app->handle($request);
    }
}
