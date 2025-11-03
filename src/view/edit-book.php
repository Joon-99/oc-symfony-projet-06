<?php
$pageTitle = "TomTroc - Editer un livre";
ob_start();
?>
<section id="edit-book" class="light-section flex-column">
    <a class="breadcrumbs-link" href="index.php?route=my-profile">← Retour</a>
    <h1 id="edit-book-title">Modifier les informations</h1>
    <div id="book-form-section" class="white-section">
        <form class="flex-row" id="edit-book-form" method="POST" action="index.php?route=edit-book&id=<?= $book->getId() ?>" enctype="multipart/form-data">
            <div id="edit-book-img-section" class="form-field flex-column">
                <label class="edit-book-input-label align-self-start">Photo</label>
                <img src="data/images/books/<?= $book->getCoverImg()->getFilePath() ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>" width="488" height="488">
                <input type="file" id="cover-img" name="cover-img" accept="image/*" class="file-hidden-input">
                <label for="cover-img" class="file-input-action align-self-end">Modifier la photo</label>
            </div>
            <div id="edit-book-info-section" class="flex-column">
                <div class="form-field">
                    <label for="title" class="edit-book-input-label">Titre</label>
                    <input class="edit-book-input-field" type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
                </div>
                <div class="form-field">
                    <label for="author" class="edit-book-input-label">Auteur</label>
                    <select id="author" name="author" class="edit-book-input-field">
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->getId() ?>" <?= $author->getId() === $book->getAuthor()->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($author->getFullName()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="description" class="edit-book-input-label">Description</label>
                    <textarea id="description" name="description" class="edit-book-input-field edit-book-input-field--tall" required><?= htmlspecialchars($book->getDescription()) ?></textarea>
                </div>
                <div class="form-field">
                    <label for="available" class="edit-book-input-label">Disponibilité</label>
                    <select id="available" name="available" class="edit-book-input-field">
                        <option value="1" <?= $book->isAvailable() ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= !$book->isAvailable() ? 'selected' : '' ?>>Non disponible</option>
                    </select>
                </div>
                <input type="submit" name="submit" class="green-cta-btn green-cta-btn--edit-book" value="Valider">
            </div>
        </form>
    </div>

</section>
<?php
$pageContent = ob_get_clean();