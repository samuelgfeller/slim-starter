<?php
/**
 * Template rendering documentation: https://samuel-gfeller.ch/docs/Template-Rendering.
 *
 * @var Slim\Views\PhpRenderer $this Rendering engine
 * @var string $basePath Base path
 */
$this->setLayout('layout/layout.html.php');

// Asset handling https://samuel-gfeller.ch/docs/Template-Rendering#asset-handling
$this->addAttribute('css', [
    'assets/home/home.css',
]);
?>

<div id="home-page-content">
    <div>
        <h1>Home</h1>
        <p>The <a target="_blank" href="https://github.com/samuelgfeller/slim-starter">Slim Starter</a> project is a
            starting
            point for building an application using the <a target="_blank" href="https://www.slimframework.com/">Slim
                Framework</a>.
        </p>
        <p> This project is a stripped-down version of the
            <a target="_blank" href="https://github.com/samuelgfeller/slim-example-project">Slim Example Project</a>
            containing only the skeleton, a few example features and a modest design. <br>
            It's built to be expanded with additional features to build an application quickly and efficiently.
        </p>
        <p>
            Included features (tested with
            <a target="_blank" href="https://github.com/sebastianbergmann/phpunit/">PHPUnit</a>):
        </p>
        <ul>
            <li>Home page</li>
            <li>User list page with users fetched via Ajax after page load</li>
            <li>User read page where values can be edited via
                <a target="_blank"
                   href="https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/contenteditable">contenteditable</a>
            </li>
            <li>API endpoint: <a target="_blank" href="<?php echo $basePath; ?>/api/users">/api/users</a>
                with <a href="<?php echo $basePath; ?>/public/frontend">frontend example</a></li>
            <li>Dark / light theme switch</li>
        </ul>
        <p>
            The Slim Starter is built with the following technologies:
        </p>
        <ul>
            <li>
                <a target="_blank" href="https://github.com/slimphp/Slim">Slim 4 micro-framework</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Dependency-Injection">Dependency
                    Injection</a> - <a target="_blank" href="https://php-di.org/">PHP-DI</a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Template-Rendering">Template
                    rendering
                </a> - <a target="_blank" href="https://github.com/slimphp/PHP-View">PHP-View</a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Database-Migrations">Database
                    migrations</a> - <a target="_blank" href="https://phinx.org/">Phinx</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Validation">
                    Validation</a> - <a target="_blank"
                                        href="https://book.cakephp.org/4/en/core-libraries/validation.html">
                    cakephp/validation</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Logging">Logging
                </a> - <a target="_blank" href="https://github.com/Seldaek/monolog">Monolog</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Writing-Tests">Integration
                    testing</a> - <a target="_blank" href="https://github.com/sebastianbergmann/phpunit/">PHPUnit</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Repository-and-Query-Builder">Query
                    Builder</a> - <a href="https://book.cakephp.org/5/en/orm/query-builder.html">cakephp/database</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Error-Handling">Error
                    handling</a> - <a target="_blank" href="https://github.com/samuelgfeller/slim-error-renderer">slim-error-renderer</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/GitHub-Actions">GitHub
                    Actions</a> - <a target="_blank" href="https://scrutinizer-ci.com/">Scrutinizer</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Coding-Standards-Fixer">Coding
                    standards fixer</a> - <a target="_blank" href="https://github.com/PHP-CS-Fixer/PHP-CS-Fixer">PHP CS
                    Fixer</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/PHPStan-Static-Code-Analysis">
                    Static code analysis</a> - <a target="_blank" href="https://github.com/phpstan/phpstan">PHPStan</a>
            </li>
        </ul>
    </div>
    <div id="documentation-div">
        <a target="_blank" href="https://samuel-gfeller.ch/docs"><h3>Documentation</h3>
            <img src="assets/home/doc-icon.svg" class="icon big-icon" id="doc-icon" alt="doc-icon">
        </a>
        <p>Relevant pages for this project:
        </p>

        <ul>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Configuration">Configuration</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Composer#autoload">Composer
                    autoload</a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Dependency-Injection">Dependency
                    Injection</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Slim-Routing">Slim-Routing</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Slim-Middlewares">Slim Middlewares</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Single-Action-Controller">Action</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Domain">Domain</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Repository-and-Query-Builder">
                    Repository and Query Builder</a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Database-Migrations">Database
                    migrations</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Writing-Tests">Writing
                    tests</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Template-Rendering">
                    Template rendering & asset handling</a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/JavaScript-Frontend#es6-modules">JS-Modules</a>,
                <a target="_blank"
                   href="https://samuel-gfeller.ch/docs/JavaScript-Frontend#ajax">Ajax</a>,
                <a target="_blank"
                   href="https://samuel-gfeller.ch/docs/JavaScript-Frontend#contenteditable-fields">
                    Contenteditable fields</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Dark-Theme">Dark
                    theme</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Validation">Validation</a>
            </li>

            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Error-Handling">Error
                    handling</a>
            </li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/Architecture">Architecture</a>
            </li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Single-Responsibility-Principle-(SRP)">
                    Single Responsibility Principle</a></li>
            <li><a target="_blank" href="https://samuel-gfeller.ch/docs/GitHub-Actions">CI/CD
                    with GitHub Actions
                </a></li>
            <li><a target="_blank"
                   href="https://samuel-gfeller.ch/docs/Coding-Standards-Fixer">PHP
                    CS-Fixer</a> &
                <a target="_blank"
                   href="https://samuel-gfeller.ch/docs/PHPStan-Static-Code-Analysis">PHPStan</a>
            </li>
            <li>
                <a target="_blank"
                   href="https://samuel-gfeller.ch/docs/XAMPP-Xdebug">Xdebug</a>
            </li>
        </ul>
    </div>
</div>
