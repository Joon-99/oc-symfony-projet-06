<?php
    $pageTitle = 'TomTroc - A propos';
    ob_start();
?>
<h1>A propos</h1>
<p style="color: purple">Details a propos de l'auteur.</p>
<?php
    $pageContent = ob_get_clean();