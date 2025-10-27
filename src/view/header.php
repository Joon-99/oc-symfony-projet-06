<a href="index.php?route=home">
    <div id="home-logo">
            <div id="logo-img">
                <span><sup>T</sup><sub>T</sub></span>
            </div>
            <p id="logo-text">Tom Troc</p>
    </div>
</a>
<div id="sections">
    <a href="index.php?route=home">Accueil</a>
    <a href="index.php?route=books">Nos livres à l'échange</a>
</div>
<div id="user-sections">
    <div id="mailbox">
        <img src="data/images/messagerie.svg">
        <a href="index.php?route=messages">Messagerie</a>
        <div id="mailbox-notif">1</div>
    </div>
    <a href="index.php?route=my-profile">Mon compte</a>
    <?php
        if (UserService::userIsLoggedIn()) {
            echo '<a href="index.php?route=logout">Déconnexion</a>';
        } else {
            echo '<a href="index.php?route=login">Connexion</a>';
        }
    ?>
</div>