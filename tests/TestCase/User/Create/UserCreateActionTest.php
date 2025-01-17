<?php

namespace App\Test\TestCase\User\Create;

use App\Test\Fixture\UserFixture;
use App\Test\Trait\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use TestTraits\Trait\DatabaseTestTrait;
use TestTraits\Trait\FixtureTestTrait;
use TestTraits\Trait\HttpJsonTestTrait;
use TestTraits\Trait\RouteTestTrait;

/**
 * Integration testing user creation.
 */
class UserCreateActionTest extends TestCase
{
    use AppTestTrait;
    use HttpJsonTestTrait;
    use RouteTestTrait;
    use DatabaseTestTrait;
    use FixtureTestTrait;

    /**
     * Test that user is created when the user submits valid data.
     *
     * @return void
     */
    public function testUserSubmitCreateAction(): void
    {
        $requestData = [
            'first_name' => 'Mary',
            'last_name' => 'Jane',
            'email' => 'mary.jane420@email.com',
        ];

        $request = $this->createJsonRequest('POST', $this->urlFor('user-create-submit'), $requestData);

        $response = $this->app->handle($request);

        self::assertSame(StatusCodeInterface::STATUS_CREATED, $response->getStatusCode());

        $this->assertTableRowCount(1, 'user');
        $userRow = $this->findLastInsertedTableRow('user');
        // Assert that user row matches request data
        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys(
            $requestData,
            $userRow,
            array_keys($requestData)
        );
    }

    /**
     * Test that no user is created and validation exception is thrown
     * when the user submits invalid data.
     *
     * @param array<string, string> $requestBody data containing invalid user create request data
     * @param array<string, string|array<string|int, mixed>> $expectedJsonResponse expected json response
     */
    #[DataProviderExternal(UserCreateProvider::class, 'invalidUserCreateCases')]
    public function testUserSubmitCreateInvalid(array $requestBody, array $expectedJsonResponse): void
    {
        // Insert random user to test the validation rule that checks for an existing email
        $this->insertFixture(UserFixture::class, ['email' => 'existing@email.com']);

        $request = $this->createJsonRequest('POST', $this->urlFor('user-create-submit'), $requestBody);

        $response = $this->app->handle($request);

        // Assert 422 Unprocessable Entity, which means validation error
        self::assertSame(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $response->getStatusCode());

        // Assert that no new user is in the database, just the fixture inserted above
        $this->assertTableRowCount(1, 'user');

        $this->assertJsonData($expectedJsonResponse, $response);
    }
}
