<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $pageTitle ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <?php // phpcs:disable Generic.Files.LineLength.TooLong ?>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <?php // phpcs:enable Generic.Files.LineLength.TooLong ?>
        <link rel="stylesheet" href="src/css/main.css">
        <script src="https://kit.fontawesome.com/acad47febf.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <?php
                require_once VIEW_PATH . '/header.php';
            ?>
        </header>
        <?php
        if (\App\Service\FlashService::hasMessages()) {
            echo '<div id="flash-section" class="dark-section">';
            require_once VIEW_PATH . '/flash.php';
            echo '</div>';
        }
        ?>
        <main>
            <?= $pageContent ?>
        </main>
        <footer>
            <?php
                require_once VIEW_PATH . '/footer.php';
            ?>
        </footer>
    </body>
</html>
