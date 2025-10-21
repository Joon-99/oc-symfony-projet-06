<?php
$pageTitle = "TomTroc - Editer un livre";
ob_start();
?>
<section id="edit-book" class="light-section">
    <h1 id="edit-book-title">Modifier les informations</h1>
    <div id="book-form-section" class="white-section">
        <form class="flex-row" id="edit-book-form" method="POST" action="index.php?route=edit-book&id=<?= $book->getId() ?>" enctype="multipart/form-data">
            <div id="edit-book-img-section" class="form-field flex-column">
                <img src="data/images/books/<?= $book->getCoverImg()->getFilePath() ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
                <input type="file" id="cover-img" name="cover-img" accept="image/*">
                <label for="cover-img">Modifier la photo</label>
            </div>
            <div id="edit-book-info-section" class="flex-column">
                <div class="form-field">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
                </div>
                <div class="form-field">
                    <label for="author">Auteur</label>
                    <select id="author" name="author">
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->getId() ?>" <?= $author->getId() === $book->getAuthor()->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($author->getFullName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?= htmlspecialchars($book->getDescription()) ?></textarea>
                </div>
                <div class="form-field">
                    <label for="available">Disponibilité</label>
                    <select id="available" name="available">
                        <option value="1" <?= $book->isAvailable() ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= !$book->isAvailable() ? 'selected' : '' ?>>Non disponible</option>
                    </select>
                </div>
                <input type="submit" name="submit" value="Valider">
            </div>
        </form>
    </div>

</section>
<?php
$pageContent = ob_get_clean();