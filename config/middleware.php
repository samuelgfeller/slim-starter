<?php

use App\Core\Application\Middleware\PhpViewMiddleware;
use App\Core\Application\Middleware\ValidationExceptionMiddleware;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use SlimErrorRenderer\Middleware\ExceptionHandlingMiddleware;
use SlimErrorRenderer\Middleware\NonFatalErrorHandlingMiddleware;

// Slim middlewares are LIFO (last in, first out) so when responding, the order is backwards
// https://samuel-gfeller.ch/docs/Slim-Middlewares#order-of-execution
return function (App $app) {
    $app->addBodyParsingMiddleware();

    // Add new middlewares here

    // Put everything possible before PhpViewMiddleware as if there is an error in a middleware,
    // the error page (and layout as well as everything else) needs this middleware loaded to work.
    $app->add(PhpViewMiddleware::class);

    // Has to be after PhpViewMiddleware https://www.slimframework.com/docs/v4/cookbook/retrieving-current-route.html
    $app->addRoutingMiddleware();

    // Has to be after Routing (called before on response)
    $app->add(BasePathMiddleware::class);

    // Error middlewares should be added last as the preprocessing (before handle) will be registered first in a request
    $app->add(ValidationExceptionMiddleware::class);
    // Handle and log notices and warnings (throws ErrorException if displayErrorDetails is true)
    $app->add(NonFatalErrorHandlingMiddleware::class);
    // Handle exceptions and display error page
    $app->add(ExceptionHandlingMiddleware::class);
};
