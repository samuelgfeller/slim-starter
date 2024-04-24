<?php
/**
 * Navbar. File fetched by the layout.
 *
 * @var Slim\Views\PhpRenderer $this Rendering engine
 * @var Slim\Interfaces\RouteParserInterface $route
 * @var Psr\Http\Message\UriInterface $uri
 * @var string $currRouteName
 */

// Assets that are part of the layout or from a file fetched by the layout must be added in the layout.html.php file.
?>

<nav>
    <div id="dark-theme-toggle-container">
        <div id="dark-theme-toggle"></div>
    </div>

    <span id="brand-name-span" class="cursor-pointer">Slim Starter</span>

    <div id="nav-links-div">
        <a href="<?php echo $route->urlFor('home-page'); ?>" <?php echo $uri->getPath() === $route->urlFor(
            'home-page'
        ) ? 'class="is-active"' : ''; ?>>Home</a>
        <a href="<?php echo $route->urlFor('user-list-page'); ?>" <?php echo in_array($currRouteName, ['user-list-page', 'user-read-page'], true) ? 'class="is-active"' : ''; ?>>Users</a>


        <div id="nav-burger-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <span class="nav-indicator no-animation-on-page-load" id="nav-indicator"></span>
    </div>

</nav>