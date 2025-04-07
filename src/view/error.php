<?php
    $pageTitle = 'TomTroc - Error';
    ob_start();
?>
<div class="error-card">
    <h1 class="error">Erreur</h1>
    <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
</div>
<?php
    $pageContent = ob_get_clean();