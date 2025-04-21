<?php
$pageTitle = "TomTroc - Inscription";
ob_start();
?>
<section id="sign-in" class="vertical-split light-section">
    <div class="left-split">
    <?php
        echo Form::renderForm(
            'Inscription',
            [
                ['type' => 'text', 'name' => 'username', 'label' => 'Pseudo', 'placeholder' => ''],
                ['type' => 'email', 'name' => 'email', 'label' => 'Adresse email', 'placeholder' => ''],
                ['type' => 'password', 'name' => 'password', 'label' => 'Mot de passe', 'placeholder' => ''],
                ['type' => 'submit', 'name' => 'submit', 'label' => 'S\'inscrire', 'placeholder' => ''],
            ],
            "index.php?route=sign-up",
        );
    ?>
    </div>
    <p class="form-cta">Déjà inscrit ? <a href="#">Connectez-vous</a></p>
    <div id="books-img" class="right-split">
        <img src="data/images/bookwall.jfif">
    </div>
</section>
<?php
$pageContent = ob_get_clean();