<?php
$pageTitle = "TomTroc - Messagerie";
ob_start();
?>
<section id="messages" class="dark-section flex-row">
    <section id="messagerie" class="light-section flex-column">
        <h2>Messagerie</h2>
        <?php foreach ($conversations as $conversation) { ?>
            <img src="<?= $conversation['user']->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image", width="50" height="50">
            <div><?= $conversation['user']->getUsername(); ?></div>
            <div><?= $conversation['last_message']->getContent(); ?></div>
        <?php } ?>
    </section> 
    <section id="conversation" class="dark-section flex-column">
        <div><?php var_dump($recipient); ?></div>
        <?php foreach ($recipientMessages as $recipientMessage) { ?>
            <div><?php var_dump($recipientMessage); ?></div>
        <?php } ?>
    </section> 
</section>


</section>
<?php
$pageContent = ob_get_clean();