<?php
$pageTitle = "TomTroc - Messagerie";
ob_start();
/** @var User $recipient */
?>
<section id="section-messagerie" class="dark-section flex-row">
    <section id="messagerie" class="light-section flex-column">
        <h2>Messagerie</h2>
        <?php foreach ($conversations as $conversation) { ?>
            <img src="<?= $conversation['user']->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="50" height="50">
            <div><?= $conversation['user']->getUsername(); ?></div>
            <div><?= $conversation['last_message']->getContent(); ?></div>
        <?php } ?>
    </section> 
    <section id="conversation" class="dark-section flex-column">
        <div class="flex-row">
            <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="50" height="50">
            <p><?= $recipient->getUsername(); ?></p>
        </div>
        <div id="messages">
            <?php foreach ($recipientMessages as $recipientMessage) {
                /** @var Message $recipientMessage */
                if ($recipientMessage->getSenderId() !== UserService::getCurrentUser()->getId()) { ?>
                    <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="15" height="15">
                <?php } ?>
                <p><?= $recipientMessage->getCreatedAt()->format('d.m H:i'); ?></p>
                <p><?= $recipientMessage->getContent(); ?></p>
            <?php } ?>
        </div>
        <div id="new-message">
            <form method="POST" action="index.php?route=send-message">
                <textarea name="message_content" placeholder="Écrire un message..." required></textarea>
                <input type="hidden" name="recipient_id" value="<?= $recipient->getId(); ?>">
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </section> 
</section>


</section>
<?php
$pageContent = ob_get_clean();