<?php
/**
 * @var string $userName
 */
$pageTitle = "TomTroc - Profil de $userName";
ob_start();
?>
<section id="external-profile" class="profile light-section">
    <div class="profile-cards">
        <div id="external-user-info" class="user-card white-section">
            <?php
                require_once 'user-card.php';
            ?>
        </div>
        <div id="ext-profile-books" class="books-card user-books-card white-section">
                <table>
                    <thead>
                        <tr>
                            <th>PHOTO</th>
                            <th>TITRE</th>
                            <th>AUTEUR</th>
                            <th>DESCRIPTION</th>
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
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
        </div>
    </div>
</section>
<?php
$pageContent = ob_get_clean();