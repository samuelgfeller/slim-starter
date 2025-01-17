<?php

use Slim\App;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Home page
    $app->get('/', \App\Module\Home\HomePageAction::class)->setName('home-page');
    $app->get('/home', \App\Module\Home\RedirectToHomePageAction::class);

    // User action routes
    $app->group('/users', function (RouteCollectorProxy $group) {
        // User list page
        $group->get('/list', \App\Module\User\List\Action\UserListPageAction::class)
            ->setName('user-list-page');
        // Fetch user list for Ajax call
        $group->get('', \App\Module\User\List\Action\UserFetchListAction::class)
            ->setName('user-list');
        // Submit user creation form
        $group->post('', \App\Module\User\Create\Action\UserCreateAction::class)
            ->setName('user-create-submit');
        // User read page
        $group->get('/{user_id:[0-9]+}', \App\Module\User\Read\Action\UserReadPageAction::class)
            ->setName('user-read-page');
        // Submit user update form
        $group->put('/{user_id:[0-9]+}', \App\Module\User\Update\Action\UserUpdateAction::class)
            ->setName('user-update-submit');
        // Submit delete user
        $group->delete('/{user_id:[0-9]+}', \App\Module\User\Delete\Action\UserDeleteAction::class)
            ->setName('user-delete-submit');
    });

    // API routes
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get('/users', \App\Module\User\List\Action\ApiUserFetchListAction::class)->setName(
            'api-fetch-users-list'
        );
    })// Cross-Origin Resource Sharing (CORS) middleware. Allow another domain to access '/api' routes.
    // If an error occurs, the CORS middleware will not be executed and the exception caught and a response
    // sent without the appropriate access control header. I don't know how to execute a certain middleware
    // added to a route group only before the error middleware which is added last in the middleware.php file.
    ->add(\App\Core\Application\Middleware\CorsMiddleware::class);

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * This route must be defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response) {
            // Throw exception 404 with route that was not found.
            throw new HttpNotFoundException(
                $request,
                'Route "' . $request->getUri()->getHost() . $request->getUri()->getPath() . '" not found.'
            );
        }
    );
};
