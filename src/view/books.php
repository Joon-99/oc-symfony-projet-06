<?php
    $pageTitle = 'TomTroc - Nos livres à l\'échange';
    ob_start();
?>
<section id="books-available" class="light-section">
    <div class="search">
        <h1>Nos livres à l'échange</h1>
        <form action="index.php?route=books" method="GET">
            <input type="hidden" name="route" value="search-book">
            <input type="search" placeholder="Rechercher un livre" id="search-book" name="search-book">
        </form>
    </div>
    <div class="book-list">
        <?php
            $authorManager = new AuthorManager();
            $userManager = new UserManager();
            $fileManager = new FileManager();

            if (!$books) {
                $books = [];
            }
            foreach ($books as $book) {
                $title = $book->getTitle();
                $author = $authorManager->findById($book->getAuthorId())->getFullName();
                $owner = $userManager->findById($book->getOwnerId())->getUsername();
                $img = $fileManager->findById($book->getCoverImgId())->getFilePath();
                $id = $book->getId();
                require 'book-card.php';
            }
        ?>
    </div>
</section>
<?php
    $pageContent = ob_get_clean();