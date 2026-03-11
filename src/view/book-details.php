<?php
$pageTitle = "TomTroc - $title";
ob_start();
?>
<section id="book-details">
    <div id="breadcrumb-trail" class="dark-section">
        <a href="index.php?route=home">Accueil</a>
        <span>&gt;</span>
        <a href="index.php?route=books">Nos livres</a>
        <span>&gt;</span>
        <a href="#"><?= htmlspecialchars($title) ?></a>
    </div>
    <div id="details" class="light-section">
        <div id="book-img">
            <img src="data/images/books/<?= $img ?>" alt="Couverture du livre en demi-page">
        </div>
        <div id="book-description">
            <h1 id="book-title"><?= htmlspecialchars($title) ?></h1>
            <div id="book-author">par <?= htmlspecialchars($author) ?></div>
            <hr>
            <div class="description-labels">DESCRIPTION</div>
            <div id="book-description-text"><?= htmlspecialchars($description) ?></div>
            <div class="description-labels">PROPRIÉTAIRE</div>
            <?php
            $userName = $ownerUsername;
            $userImg = $ownerImage;
            $userId = $ownerId;
            require_once VIEW_PATH . '/user-tag.php';
            ?>
            <a href="index.php?route=messages&recipient_id=<?= $userId ?>" id="send-message-btn">Envoyer un message</a>
        </div>
    </div>
</section>
<?php
$pageContent = ob_get_clean();
