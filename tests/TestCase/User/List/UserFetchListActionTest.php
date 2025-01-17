<?php

namespace App\Test\TestCase\User\List;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\DatabaseTestTrait;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\RouteTestTrait;

/**
 * Integration testing user fetch list action.
 */
class UserFetchListActionTest extends TestCase
{
    use AppTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use DatabaseTestTrait;
    use FixtureTestTrait;

    /**
     * Tests users that are loaded via ajax from the user list page.
     *
     * @return void
     */
    public function testUserFetchList(): void
    {
        // Insert 2 users
        $userRows = $this->insertFixture(UserFixture::class, ['first_name' => 'Bob'], ['first_name' => 'Alice']);

        // Make request
        $request = $this->createJsonRequest('GET', $this->urlFor('user-list'));
        $response = $this->app->handle($request);
        // Assert status code
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());

        // Expected response data is the same as the user rows except for the keys being camelCase
        $expectedResponseData = array_map(static function ($userRow) {
            return [
                // camelCase according to Google recommendation https://stackoverflow.com/a/19287394/9013718
                'id' => $userRow['id'],
                'firstName' => $userRow['first_name'],
                'lastName' => $userRow['last_name'],
                'email' => $userRow['email'],
            ];
        }, $userRows);

        // Assert userDataArray from response data
        $this->assertPartialJsonData($expectedResponseData, $this->getJsonData($response)['userDataArray']);
    }
}
