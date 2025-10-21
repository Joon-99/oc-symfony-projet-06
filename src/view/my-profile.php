<?php
$pageTitle = "TomTroc - Mon compte";
ob_start();
?>
<section id="my-profile" class="profile light-section">
    <h1>Mon compte</h1>
    <div id="profile-info-section">
        <div class="user-card white-section">
            <?php
                require_once 'user-card.php';
            ?>
        </div>
        <div class="modif-user-card white-section">
            <form id="modif-user-form" method="POST" action="index.php?route=my-profile">
                <h2>Vos informations personnelles</h2>
                <div class="form-field">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($userEmail) ?>">
                </div>
                <div class="form-field">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="" placeholder="•••••••••">
                </div>
                <div class="form-field">
                    <label for="username">Pseudo</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($userName) ?>">
                </div>
                <input type="submit" name="submit" value="Enregistrer">
            </form>
        </div>
    </div>
    <div id="profile-books" class="books-card user-books-card white-section">
            <table>
                <thead>
                    <tr>
                        <th>PHOTO</th>
                        <th>TITRE</th>
                        <th>AUTEUR</th>
                        <th>DESCRIPTION</th>
                        <th>DISPONIBILITE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($userBooks as $book) {
                        /** @var Book $book */
                        $availableClass = $book->isAvailable() ? 'available' : 'not-available';
                        ?>

                        <tr>
                            <td><img src="data/images/books/<?= $book->getCoverImg()->getFilePath() ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>"></td>
                            <td><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= htmlspecialchars($book->getAuthor()->getFullName()) ?></td>
                            <td><?= htmlspecialchars($book->getDescription()) ?></td>
                            <td>
                                <div class="available-tag <?= $availableClass ?>">
                                    <?= $book->isAvailable() ? 'disponible' : 'non dispo.' ?>
                                </div>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="index.php?route=edit-book&id=<?= $book->getId()?>" class="books-card-link">Editer</a>
                                    <a href="index.php?route=delete-book&id=<?= $book->getId() ?>" class="books-card-link important" onclick="confirm(<?= Book::DELETE_CONFIRM ?>)">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
    </div>
</section>
<?php
$pageContent = ob_get_clean();