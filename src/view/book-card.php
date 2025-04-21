<a href="index.php?route=book-details&id=<?= $id ?>" class="book-card-link">
    <div class="book-card">
        <div class="book-card-img">
            <img src="data/images/books/<?= $img ?>">
        </div>
        <div class="book-card-description">
            <p class="book-card-title"><?= $title ?></p>
            <p class="book-card-author"><?= $author ?></p>
            <p class="book-card-owner">Vendu par : <?= $owner ?></p>
        </div>
    </div>
</a>