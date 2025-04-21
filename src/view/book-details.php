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
        <a href="#"><?= $title ?></a>
    </div>
    <div id="details" class="light-section">
        <div id="book-img">
            <img src="data/images/books/<?= $img ?>">
        </div>
        <div id="book-description">
            <h1 id="book-title"><?= $title ?></h1>
            <div id="book-author">par <?= $author ?></div>
            <hr>
            <div class="description-labels">DESCRIPTION</div>
            <div id="book-description-text"><?= $description ?></div>
            <div class="description-labels">PROPRIÉTAIRE</div>
            <?php
            $userName = $ownerUsername;
            $userImg = $ownerImage;
            require_once 'user-tag.php';
            ?>
            <a href="#" id="send-message-btn">Envoyer un message</a>
        </div>
    </div>
</section>
<?php
$pageContent = ob_get_clean();