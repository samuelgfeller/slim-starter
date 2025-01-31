<div align="center">
<a href="https://github.com/samuelgfeller/slim-starter">
<img src="https://github.com/samuelgfeller/slim-example-project/assets/31797204/8e39b63f-adbf-443c-8ed9-dc5924fd4e0c" width="100px">  
</a>

## Slim Starter

[![Documentation](https://img.shields.io/badge/Documentation-blue?logo=data%3Aimage%2Fsvg%2Bxml%3Bbase64%2CPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIFRyYW5zZm9ybWVkIGJ5OiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4KPHN2ZyB3aWR0aD0iODAwcHgiIGhlaWdodD0iODAwcHgiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KDTxnIGlkPSJTVkdSZXBvX2JnQ2FycmllciIgc3Ryb2tlLXdpZHRoPSIwIi8%2BCg08ZyBpZD0iU1ZHUmVwb190cmFjZXJDYXJyaWVyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KDTxnIGlkPSJTVkdSZXBvX2ljb25DYXJyaWVyIj4gPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik05Ljk0NTMxIDEuMjVIMTQuMDU1MUMxNS40MjI3IDEuMjQ5OTggMTYuNTI1IDEuMjQ5OTYgMTcuMzkxOSAxLjM2NjUyQzE4LjI5MiAxLjQ4NzU0IDE5LjA0OTkgMS43NDY0MyAxOS42NTE4IDIuMzQ4MzVDMjAuMjUzOCAyLjk1MDI3IDIwLjUxMjYgMy43MDgxNCAyMC42MzM3IDQuNjA4MjVDMjAuNzUwMiA1LjQ3NTIyIDIwLjc1MDIgNi41Nzc1NCAyMC43NTAyIDcuOTQ1MTNWMTYuMDU0OUMyMC43NTAyIDE3LjQyMjUgMjAuNzUwMiAxOC41MjQ4IDIwLjYzMzcgMTkuMzkxOEMyMC41MTI2IDIwLjI5MTkgMjAuMjUzOCAyMS4wNDk3IDE5LjY1MTggMjEuNjUxN0MxOS4wNDk5IDIyLjI1MzYgMTguMjkyIDIyLjUxMjUgMTcuMzkxOSAyMi42MzM1QzE2LjUyNSAyMi43NSAxNS40MjI2IDIyLjc1IDE0LjA1NTEgMjIuNzVIOS45NDUzMkM4LjU3NzczIDIyLjc1IDcuNDc1NCAyMi43NSA2LjYwODQ0IDIyLjYzMzVDNS43MDgzMyAyMi41MTI1IDQuOTUwNDUgMjIuMjUzNiA0LjM0ODU0IDIxLjY1MTdDMy43NDY2MiAyMS4wNDk3IDMuNDg3NzMgMjAuMjkxOSAzLjM2NjcxIDE5LjM5MThDMy4zMjgwMSAxOS4xMDM5IDMuMzAyMTYgMTguNzkwMiAzLjI4NDkgMTguNDQ5NEMzLjI0NTgyIDE4LjMyNiAzLjIzODIxIDE4LjE5MTIgMy4yNjg5NSAxOC4wNTY4QzMuMjUwMTYgMTcuNDY0OSAzLjI1MDE3IDE2Ljc5OTEgMy4yNTAxOSAxNi4wNTQ5VjcuOTQ1MTNDMy4yNTAxNyA2LjU3NzU0IDMuMjUwMTUgNS40NzUyMiAzLjM2NjcxIDQuNjA4MjVDMy40ODc3MyAzLjcwODE0IDMuNzQ2NjIgMi45NTAyNyA0LjM0ODU0IDIuMzQ4MzVDNC45NTA0NSAxLjc0NjQzIDUuNzA4MzMgMS40ODc1NCA2LjYwODQzIDEuMzY2NTJDNy40NzU0IDEuMjQ5OTYgOC41Nzc3MiAxLjI0OTk4IDkuOTQ1MzEgMS4yNVpNNC43NzY5NCAxOC4yNDkxQzQuNzkyMTQgMTguNjAyOSA0LjgxNTk3IDE4LjkxNCA0Ljg1MzMzIDE5LjE5MTlDNC45NTE5OSAxOS45MjU3IDUuMTMyNDMgMjAuMzE0MiA1LjQwOTIgMjAuNTkxQzUuNjg1OTYgMjAuODY3OCA2LjA3NDUzIDIxLjA0ODIgNi44MDgzMSAyMS4xNDY5QzcuNTYzNjYgMjEuMjQ4NCA4LjU2NDc3IDIxLjI1IDEwLjAwMDIgMjEuMjVIMTQuMDAwMkMxNS40MzU2IDIxLjI1IDE2LjQzNjcgMjEuMjQ4NCAxNy4xOTIxIDIxLjE0NjlDMTcuOTI1OCAyMS4wNDgyIDE4LjMxNDQgMjAuODY3OCAxOC41OTEyIDIwLjU5MUMxOC43ODc1IDIwLjM5NDcgMTguOTM1MyAyMC4xNDIxIDE5LjAzOTkgMTkuNzVIOC4wMDAxOUM3LjU4NTk3IDE5Ljc1IDcuMjUwMTkgMTkuNDE0MiA3LjI1MDE5IDE5QzcuMjUwMTkgMTguNTg1OCA3LjU4NTk3IDE4LjI1IDguMDAwMTkgMTguMjVIMTkuMjIzNEMxOS4yNDE5IDE3LjgxOSAxOS4yNDc3IDE3LjMyNDYgMTkuMjQ5NCAxNi43NUg3Ljg5Nzk2QzYuOTE5NzEgMTYuNzUgNi41Nzc3IDE2Ljc1NjQgNi4zMTU2MiAxNi44MjY3QzUuNTk2MyAxNy4wMTk0IDUuMDIyODYgMTcuNTU0MSA0Ljc3Njk0IDE4LjI0OTFaTTE5LjI1MDIgMTUuMjVINy44OTc5NkM3Ljg1ODc5IDE1LjI1IDcuODIwMiAxNS4yNSA3Ljc4MjE3IDE1LjI1QzYuOTY0MiAxNS4yNDk3IDYuNDA2MDUgMTUuMjQ5NSA1LjkyNzM5IDE1LjM3NzhDNS40OTk0MSAxNS40OTI1IDUuMTAyNDIgMTUuNjc5OCA0Ljc1MDE5IDE1LjkyNTlWOEM0Ljc1MDE5IDYuNTY0NTggNC43NTE3OCA1LjU2MzQ3IDQuODUzMzMgNC44MDgxMkM0Ljk1MTk5IDQuMDc0MzUgNS4xMzI0MyAzLjY4NTc3IDUuNDA5MiAzLjQwOTAxQzUuNjg1OTYgMy4xMzIyNSA2LjA3NDUzIDIuOTUxOCA2LjgwODMxIDIuODUzMTVDNy41NjM2NiAyLjc1MTU5IDguNTY0NzcgMi43NSAxMC4wMDAyIDIuNzVIMTQuMDAwMkMxNS40MzU2IDIuNzUgMTYuNDM2NyAyLjc1MTU5IDE3LjE5MjEgMi44NTMxNUMxNy45MjU4IDIuOTUxOCAxOC4zMTQ0IDMuMTMyMjUgMTguNTkxMiAzLjQwOTAxQzE4Ljg2NzkgMy42ODU3NyAxOS4wNDg0IDQuMDc0MzUgMTkuMTQ3IDQuODA4MTJDMTkuMjQ4NiA1LjU2MzQ3IDE5LjI1MDIgNi41NjQ1OCAxOS4yNTAyIDhWMTUuMjVaTTcuMjUwMTkgN0M3LjI1MDE5IDYuNTg1NzkgNy41ODU5NyA2LjI1IDguMDAwMTkgNi4yNUgxNi4wMDAyQzE2LjQxNDQgNi4yNSAxNi43NTAyIDYuNTg1NzkgMTYuNzUwMiA3QzE2Ljc1MDIgNy40MTQyMSAxNi40MTQ0IDcuNzUgMTYuMDAwMiA3Ljc1SDguMDAwMTlDNy41ODU5NyA3Ljc1IDcuMjUwMTkgNy40MTQyMSA3LjI1MDE5IDdaTTcuMjUwMTkgMTAuNUM3LjI1MDE5IDEwLjA4NTggNy41ODU5NyA5Ljc1IDguMDAwMTkgOS43NUgxMy4wMDAyQzEzLjQxNDQgOS43NSAxMy43NTAyIDEwLjA4NTggMTMuNzUwMiAxMC41QzEzLjc1MDIgMTAuOTE0MiAxMy40MTQ0IDExLjI1IDEzLjAwMDIgMTEuMjVIOC4wMDAxOUM3LjU4NTk3IDExLjI1IDcuMjUwMTkgMTAuOTE0MiA3LjI1MDE5IDEwLjVaIiBmaWxsPSIjZmZmIi8%2BIDwvZz4KDTwvc3ZnPg%3D%3D&labelColor=grey)](https://samuel-gfeller.ch/docs)
[![Latest Version on Packagist](https://img.shields.io/github/release/samuelgfeller/slim-starter.svg)](https://packagist.org/packages/samuelgfeller/slim-starter)
[![Code Coverage](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/build-status/master)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/samuelgfeller/slim-starter.svg)](https://scrutinizer-ci.com/g/samuelgfeller/slim-starter/?branch=master)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/samuelgfeller/slim-starter/blob/master/LICENSE)

[Slim 4](https://www.slimframework.com/) full stack starter template following current best practices and
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

This project, unlike the official
[Slim-Skeleton](https://github.com/slimphp/Slim-Skeleton) and
Odan's [slim4-skeleton](https://github.com/odan/slim4-skeleton)
has some additional opinionated
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
(could be replaced by [Twig](https://twig.symfony.com/))
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

If you value this project and want to support it, star it on GitHub or
visit the [Support❤️](https://samuel-gfeller.ch/docs/Support❤️) page. (thank you!)

## License

This project is licensed under the MIT License — see the
[LICENSE](https://github.com/samuelgfeller/slim-starter/blob/master/LICENSE) file for details.
