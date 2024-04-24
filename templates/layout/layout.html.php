<?php
/**
 * Layout template.
 * Template rendering documentation: https://github.com/samuelgfeller/slim-example-project/wiki/Template-rendering.
 *
 * @var Slim\Views\PhpRenderer $this
 * @var string $basePath
 * @var string $content PHP-View var page content
 * @var Slim\Interfaces\RouteParserInterface $route
 * @var string $currRouteName current route name
 * @var Psr\Http\Message\UriInterface $uri
 * @var array<string, mixed> $config 'public' configuration values
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--  Trailing slash has to be avoided on asset paths. Otherwise, <base> does not work  -->
    <base href="<?php echo html($basePath); ?>/"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

    <?php
    // Define layout assets
    $layoutCss = [
        'assets/general/general-font/fonts.css',
        'assets/general/general-css/general.css',
        'assets/general/general-css/colors.css',
        'assets/general/general-css/layout.css',
        'assets/navbar/horizontal-navbar.css',
        'assets/general/page-component/flash-message/flash-message.css',
        'assets/general/dark-mode/dark-mode-toggle-button.css',
    ];
$layoutJs = ['assets/navbar/navbar.js', 'assets/general/dark-mode/dark-mode.js'];
$layoutJsModules = ['assets/general/general-js/default.js'];

// fetch() includes another template in the current template
// Include template that renders the asset paths
echo $this->fetch(
    'layout/assets.html.php',
    [ // Merge layout assets and assets required by templates (added via $this->addAttribute())
        'stylesheets' => array_merge($layoutCss, $css ?? []),
        'scripts' => array_merge($layoutJs, $js ?? []),
        // The type="module" allows the use of import and export inside a JS file.
        'jsModules' => array_merge($layoutJsModules, $jsModules ?? []),
    ]
);
?>

    <title><?php echo html($config['app_name']); ?></title>

    <script>
        // Dark theme: https://github.com/samuelgfeller/slim-example-project/wiki/Dark-Theme
        // Add the theme immediately to the <html> element before everything else for the correct colors
        document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') ?? 'light');
    </script>
</head>
<body>
<!-- "In terms of semantics, <div> is the best choice" as wrapper https://css-tricks.com/best-way-implement-wrapper-css -->
<!-- Wrapper should encompass entire body content as its height is 100vh -->
<div id="wrapper">
    <header>
        <!-- Navbar -->
        <?php echo $this->fetch('layout/navbar.html.php', []); ?>

        <?php
    // Add session and flash messages: https://github.com/samuelgfeller/slim-example-project/wiki/Session-and-Flash-messages
?>
    </header>

    <main>
        <?php echo /* Reserved PHPView variable for the template content */
$content; ?>
    </main>

    <?php echo $this->fetch('layout/footer.html.php', []); ?>
</div>

</body>
</html>

