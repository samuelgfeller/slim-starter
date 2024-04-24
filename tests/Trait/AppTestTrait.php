<?php

namespace App\Test\Trait;

use Cake\Database\Connection;
use DI\Container;
use Slim\App;
use TestTraits\Trait\ContainerTestTrait;
use UnexpectedValueException;

/**
 * Initialize slim app for testing.
 * Test setup documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Writing-Tests#setup
 * Traits "extend" the class that include them with their content (via "use TraitName;").
 */
trait AppTestTrait
{
    use ContainerTestTrait;

    protected App $app;

    /**
     * PHP Unit function setUp is called automatically before each test.
     */
    protected function setUp(): void
    {
        // Start slim app
        $this->app = require __DIR__ . '/../../config/bootstrap.php';

        // Set $this->container to container instance
        $this->setUpContainer($this->app->getContainer());

        // If setUp() is called in a testClass that uses DatabaseTestTrait, the method setUpDatabase() exists
        if (method_exists($this, 'setUpDatabase')) {
            // Check that database name from config contains the word "test"
            // This is a double security check to prevent unwanted use of dev db for testing
            if (!str_contains($this->container->get('settings')['db']['database'], 'test')) {
                throw new UnexpectedValueException('Test database name MUST contain the word "test"');
            }

            // Create tables
            $this->setUpDatabase($this->container->get('settings')['root_dir'] . '/resources/schema/schema.sql');
        }
    }

    /**
     * Function called after each test
     * Close database connection to prevent errors:
     *  - PDOException: Packets out of order. Expected 0 received 1. Packet size=23
     *  - PDOException: SQLSTATE[HY000] [2006] MySQL server has gone away
     *  - Cake\Database\Exception\MissingConnectionException:
     *        Connection to Mysql could not be established: SQLSTATE[08004] [1040] Too many connections.
     *
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     *
     * @return void
     */
    protected function tearDown(): void
    {
        // Disconnect from database to avoid "too many connections" errors
        if (method_exists($this, 'setUpDatabase')) {
            $connection = $this->container->get(Connection::class);
            $connection->rollback();
            $connection->getDriver()->disconnect();
            if ($this->container instanceof Container) {
                $this->container->set(Connection::class, null);
                $this->container->set(\PDO::class, null);
            }
        }
    }
}
