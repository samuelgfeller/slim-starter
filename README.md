<div align="center">
<a href="https://github.com/samuelgfeller/slim-starter">
<img src="https://github.com/samuelgfeller/slim-example-project/assets/31797204/8e39b63f-adbf-443c-8ed9-dc5924fd4e0c" width="100px">  
</a>

## Slim Starter

[![Latest Version on Packagist](https://img.shields.io/github/release/samuelgfeller/slim-starter.svg)](https://packagist.org/packages/samuelgfeller/slim-starter)
[![Code Coverage](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/build-status/master)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/samuelgfeller/slim-starter.svg)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/?branch=master)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/samuelgfeller/slim-starter/blob/master/LICENSE)

[Slim 4](https://www.slimframework.com/) full stack starter template following 2024 best practices and
[SOLID](https://en.wikipedia.org/wiki/SOLID) principles to quickly get started with a scalable PHP web application.

An extensive [**documentation**](https://samuel-gfeller/docs) explains
the [architecture](https://samuel-gfeller.ch/docs/Architecture), components,
design choices (i.e. 
[SRP](https://samuel-gfeller.ch/docs/Single-Responsibility-Principle-(SRP)))
and features.  
[Libraries](https://samuel-gfeller.ch/docs/Libraries-and-Framework)
are kept to a minimum and to allow for most flexibility and long-term viability.

</div>

## Features

The base for this project was the official
[Slim-Skeleton](https://github.com/slimphp/Slim-Skeleton) and
Odan's [slim4-skeleton](https://github.com/odan/slim4-skeleton)
but with a lot of additional opinionated
features and examples such as:

* Pages rendered by a [template renderer](https://samuel-gfeller.ch/docs/Template-Rendering) 
with layout and versioned assets
* The loading example elements from the database (users) via Ajax
* The creation, modification, and deletion of users with validation
* Integration testing
* API endpoint
* Dark / light theme switch

This skeleton template is a stripped-down version of the
[slim-example-project](https://github.com/samuelgfeller/slim-example-project) which contains 
a lot more features and examples.

### Technologies

* [Slim 4 micro-framework](https://github.com/slimphp/Slim)
* [Dependency Injection](https://samuel-gfeller.ch/docs/Dependency-Injection) - [PHP-DI](https://php-di.org/)
* [Template rendering](https://samuel-gfeller.ch/docs/Template-Rendering) - [PHP-View](https://github.com/slimphp/PHP-View) 
(can be replaced by [Twig](https://twig.symfony.com/))
* [Logging](https://samuel-gfeller.ch/docs/Logging) - [Monolog](https://github.com/Seldaek/monolog)
* [Database migrations](https://samuel-gfeller.ch/docs/Database-Migrations) - [Phinx](https://phinx.org/)
* [Validation](https://samuel-gfeller.ch/docs/Validation) - [cakephp/validation](https://book.cakephp.org/4/en/core-libraries/validation.html)
* [Query Builder](https://samuel-gfeller.ch/docs/Repository-and-Query-Builder) - [cakephp/database](https://book.cakephp.org/5/en/orm/query-builder.html)
* [Integration testing](https://samuel-gfeller.ch/docs/Writing-Tests) - [PHPUnit](https://github.com/sebastianbergmann/phpunit/)
* [Error handling](https://samuel-gfeller.ch/docs/Error-Handling) - [slim-error-renderer](https://github.com/samuelgfeller/slim-error-renderer)
* [GitHub Actions](https://samuel-gfeller.ch/docs/GitHub-Actions) and [Scrutinizer](https://samuel-gfeller.ch/docs/How-to-set-up-Scrutinizer)
* [Coding standards fixer](https://samuel-gfeller.ch/docs/Coding-Standards-Fixer) - [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)
* [Static code analysis](https://samuel-gfeller.ch/docs/PHPStan-Static-Code-Analysis) - [PHPStan](https://github.com/phpstan/phpstan)

## Requirements
* PHP 8.2+
* [Composer](https://samuel-gfeller.ch/docs/Composer)
* MariaDB or MySQL database

## Installation
#### 1. Create project
Navigate to the directory you want to create the project in and run the following 
command, replacing `project-name` with the desired name for your project.
```bash
composer create-project samuelgfeller/slim-starter project-name
```
This will create a new directory with the specified name and install all 
necessary dependencies.

#### 2. Set up the database
Open the project in your IDE and rename the file `config/env/env.example.php` to `config/env/env.php` 
and add the local database credentials.  

Then, create the database for the project and add the name to the `config/env/env.dev.php` 
file, like this:
```php
$settings['db']['database'] = 'my_dev_database_name';
```
After that, create a separate database for testing and add the name to the `config/env/env.test.php` 
file.   
The database name must contain the word "test" as a safety measure to prevent 
accidentally truncating the development database while testing.
```php
$settings['db']['database'] = 'my_dev_database_name_test';
```

The [Configuration](https://samuel-gfeller.ch/docs/Configuration) 
documentation details the different configuration files and how they are used and loaded. 

#### 3. Run migrations
Open the terminal in the project's root directory and run the following command to create the 
demo table `user`:
```bash
composer migrate
```

#### 4. Insert demo data
Four demo users can be inserted into the database to test the application and API response by
running the following command:

```bash
composer seed
```

#### 5. Update GitHub workflows

To run the project's tests automatically when pushing, update the 
`.github/workflows/build.yml` file.   
Replace the matrix value "test-database" with the name of 
your test database as specified in `config/env/env.test.php`.

If you don't plan on using Scrutinizer, remove the `.scrutinizer` file at the root of the project,
otherwise you can follow this
[guide](https://samuel-gfeller.ch/docs/How-to-set-up-Scrutinizer)
on how to set it up.

#### Done!
That's it! Your project should now be fully set up and ready to use.  
If you are using XAMPP and installed the project in the `htdocs` folder, you can access it 
in the browser at `http://localhost/project-name`.  
Or you can serve it locally by running `php -S localhost:8080 -t public/` in the project's root 
directory.

## Support

Please read the [Support❤️](https://samuel-gfeller.ch/docs/Support❤️) page
if you value this project and its documentation and want to support it.

## License

This project is licensed under the MIT License — see the
[LICENSE](https://github.com/samuelgfeller/slim-example-project/blob/master/LICENSE) file for details.
