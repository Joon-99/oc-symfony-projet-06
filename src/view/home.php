<?php
    $pageTitle = 'TomTroc - Accueil';
    ob_start();
?>
<section id="hero" class="dark-section">
    <div id="hero-description">
        <h1>Rejoignez nos lecteurs passionnés<h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. 
            Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
        <button class="green-cta-btn">
            Découvrir
        </button>
    </div>
    <div id="hero-img">
        <img src="data/images/librarian.jpg">
        <p>Hamza</p>
    </div>
</section>
<section id="last-books" class="light-section">
    <h2>Les derniers livres ajoutés</h2>
    <div class="book-list">
        <?php
            //TODO check le probleme d'alignement du paragraphe des valeurs
            $bookManager = new BookManager();
            $authorManager = new AuthorManager();
            $userManager = new UserManager();
            $fileManager = new FileManager();
            $books = $bookManager->findAll();

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
    <button class="green-cta-btn"><a href="index.php?route=books">Voir tous les livres</a></button>
</section>
<section id="steps" class="dark-section">
    <h2>Comment ça marche ?</h2>
    <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div id="step-list">
    <?php
        $steps = [
            "Inscrivez-vous gratuitement sur notre plateforme.",
            "Ajoutez les livres que vous souhaitez échanger à votre profil.",
            "Parcourez les livres disponibles chez d'autres membres.",
            "Proposez un échange et discutez avec d'autres passionnés de lecture.",
        ];
        foreach ($steps as $step) {
            echo '<div class="step-card">' . $step . '</div>';
        }
    ?>
    </div>
    <button class="transparent-cta-btn">Voir tous les livres</button>
</section>
<div id="banner">
</div>
<section id="our-values" class="dark-section">
    <h2>Nos valeurs</h2>
    <p class="letter">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont 
        ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. 
        Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
    <p class="letter">Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
    <p class="letter">Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, 
        de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
    <div id="signature">
        <p id="signature-text">L'équipe Tom Troc</p>
        <img id="signature-img" src="data/images/signature-heart.svg">
    </div>
</section>

<?php
    $pageContent = ob_get_clean();