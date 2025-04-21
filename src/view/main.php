<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $pageTitle ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="src/css/main.css">
        <script src="https://kit.fontawesome.com/acad47febf.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <?php
                require_once 'header.php';
            ?>
        </header>
        <?php
            if (FlashService::hasMessages()) {
                echo '<div id="flash-section">';
                require_once 'flash.php';
                echo '</div>';
            }
        ?>
        <main>
            <?= $pageContent ?>
        </main>
        <footer>
            <?php
                require_once 'footer.php';
            ?>
        </footer>
    </body>
</html>