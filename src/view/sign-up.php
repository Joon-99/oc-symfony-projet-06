<?php
$pageTitle = "TomTroc - Inscription";
ob_start();
?>
<section id="sign-in" class="vertical-split light-section">
    <div class="left-split light-section">
        <div class="left-split-content">
        <?php
            require_once VIEW_PATH . '/form.php';
            echo \App\View\Form::renderForm(
                'Inscription',
                [
                    ['type' => 'text', 'name' => 'username', 'label' => 'Pseudo', 'placeholder' => '',
                    'required' => 'required'],
                    ['type' => 'email', 'name' => 'email', 'label' => 'Adresse email', 'placeholder' => '',
                    'required' => 'required'],
                    ['type' => 'password', 'name' => 'password', 'label' => 'Mot de passe', 'placeholder' => '',
                    'required' => 'required'],
                    ['type' => 'submit', 'name' => 'submit', 'label' => 'S\'inscrire', 'placeholder' => '',
                    'required' => 'required'],
                ],
                "index.php?route=sign-up",
                "S'inscrire",
            );
            ?>
            <p class="form-cta">Déjà inscrit ? <a href="index.php?route=login">Connectez-vous</a></p>
        </div>
    </div>
    <div id="books-img" class="right-split">
        <img src="data/images/bookwall.jfif" alt="photo d'un mur de livres">
    </div>
</section>
<?php
$pageContent = ob_get_clean();
