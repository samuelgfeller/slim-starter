<?php

namespace App\Test\TestCase\User\Delete;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\DatabaseTestTrait;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\RouteTestTrait;

/**
 * Integration testing user deletion.
 */
class UserDeleteActionTest extends TestCase
{
    use AppTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use DatabaseTestTrait;
    use FixtureTestTrait;

    public function testUserSubmitDeleteAction(): void
    {
        // Insert random user to delete
        $userToDeleteRow = $this->insertFixture(UserFixture::class);

        $request = $this->createJsonRequest(
            'DELETE',
            // Construct url /users/1 with urlFor()
            $this->urlFor('user-delete-submit', ['user_id' => $userToDeleteRow['id']]),
        );

        $response = $this->app->handle($request);

        // Assert status code: 200 OK
        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());

        // Assert response json content
        $this->assertJsonData(['status' => 'success'], $response);

        // Assert database
        // Assert that column deleted_at is NOT null, which means that user is deleted
        self::assertNotNull($this->getTableRowById('user', $userToDeleteRow['id'], ['deleted_at']));
    }
}
