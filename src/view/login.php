<?php
$pageTitle = "TomTroc - Connexion";
ob_start();
?>
<section id="sign-in" class="vertical-split light-section">
    <div class="left-split light-section">
        <div class="left-split-content">
        <?php
            echo Form::renderForm(
                'Connexion',
                [
                    ['type' => 'email', 'name' => 'email', 'label' => 'Adresse email', 'placeholder' => '', 'required' => 'required'],
                    ['type' => 'password', 'name' => 'password', 'label' => 'Mot de passe', 'placeholder' => '', 'required' => 'required'],
                    ['type' => 'submit', 'name' => 'submit', 'label' => 'S\'inscrire', 'placeholder' => '', 'required' => 'required'],
                ],
                "index.php?route=login",
                "Se connecter",
            );
        ?>
            <p class="form-cta">Pas de compte ? <a href="index.php?route=sign-up">Inscrivez-vous</a></p>
        </div>
    </div>
    <div id="books-img" class="right-split">
        <img src="data/images/bookwall.jfif">
    </div>
</section>
<?php
$pageContent = ob_get_clean();