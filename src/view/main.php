<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $pageTitle ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="src/css/main.css">
    </head>
    <body>
        <header>
            <?php
                // $headerHtml = '<div style="height: 30px; width: 100%; background-color: crimson"></div>';
                // echo $headerHtml;
                require_once 'header.php';
            ?>
        </header>
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