<?php

namespace App\Test\Integration\User;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\DatabaseTestTrait;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\HttpTestTrait;
use TestTraits\Trait\RouteTestTrait;

/**
 * Integration testing user update.
 */
class UserUpdateActionTest extends TestCase
{
    use AppTestTrait;
    use HttpTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use DatabaseTestTrait;
    use FixtureTestTrait;

    /**
     * Test that user is updated when the user submits valid data.
     *
     * @return void
     */
    public function testUserSubmitUpdateAction(): void
    {
        $userRow = $this->insertFixture(UserFixture::class);
        $updateRequestData = [
            'first_name' => 'Johnny',
            'last_name' => 'Cash',
            'email' => 'johnny.cash@email.com',
        ];

        $request = $this->createJsonRequest(
            'PUT',
            $this->urlFor('user-update-submit', ['user_id' => $userRow['id']]),
            $updateRequestData
        );

        $response = $this->app->handle($request);

        self::assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());

        $this->assertTableRowCount(1, 'user');
        // Assert that user row matches request data
        $this->assertTableRow($updateRequestData, 'user', $userRow['id']);
    }

    /**
     * Test that validation exception is thrown
     * when the user submits invalid update data.
     *
     * @param array<string, string> $requestBody data containing invalid user create request data
     * @param array<string, string|array<string|int, mixed>> $expectedJsonResponse expected json response
     */
    #[DataProviderExternal(\App\Test\Provider\User\UserUpdateProvider::class, 'invalidUserUpdateCases')]
    public function testUserSubmitUpdateInvalid(array $requestBody, array $expectedJsonResponse): void
    {
        // Insert user that will be updated
        $userToUpdate = $this->insertFixture(UserFixture::class);
        // Insert random user to test the validation rule that checks for an existing email
        $this->insertFixture(UserFixture::class, ['email' => 'existing@email.com']);

        $request = $this->createJsonRequest(
            'PUT',
            $this->urlFor('user-update-submit', ['user_id' => $userToUpdate['id']]),
            $requestBody
        );

        $response = $this->app->handle($request);

        // Assert 422 Unprocessable Entity, which means validation error
        self::assertSame(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        // Assert that the inserted rows are unchanged
        $this->assertTableRow($userToUpdate, 'user', $userToUpdate['id']);

        $this->assertJsonData($expectedJsonResponse, $response);
    }
}
