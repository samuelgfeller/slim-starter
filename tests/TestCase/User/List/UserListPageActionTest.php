<?php

namespace App\Test\TestCase\User\List;

use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\HttpTestTrait;
use TestTraits\Trait\RouteTestTrait;

class UserListPageActionTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;
    use RouteTestTrait;

    /**
     * Test that "user list" page loads with status 200 OK.
     *
     * @return void
     */
    public function testUserListPageAction(): void
    {
        $request = $this->createRequest('GET', $this->urlFor('user-list-page'));

        $response = $this->app->handle($request);

        // Assert 200 OK
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }
}
