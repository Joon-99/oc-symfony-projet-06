<?php
$pageTitle = "TomTroc - Messagerie";
ob_start();
/** @var User $recipient */
?>
<section id="section-messagerie" class="dark-section flex-row">
    <section id="messagerie" class="light-section flex-column">
        <h2>Messagerie</h2>
        <?php 
        if (!empty($conversations)) {
            foreach ($conversations as $conversation) { ?>
                <img src="<?= $conversation['user']->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="50" height="50">
                <div><?= htmlspecialchars($conversation['user']->getUsername()); ?></div>
                <div><?= htmlspecialchars($conversation['last_message']->getContent()); ?></div>
            <?php } ?>
        <?php } else { ?>
            <p>Aucune conversation disponible.</p>
        <?php } ?>
    </section> 
    <section id="conversation" class="dark-section flex-column">
        <?php if ($recipient !== null) { ?>
        <div class="flex-row">
            <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="50" height="50">
            <p><?= htmlspecialchars($recipient->getUsername()); ?></p>
        </div>
        <div id="messages">
            <?php foreach ($recipientMessages as $recipientMessage) {
                /** @var Message $recipientMessage */
                if ($recipientMessage->getSenderId() !== UserService::getCurrentUser()->getId()) { ?>
                    <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="15" height="15">
                <?php } ?>
                <p><?= $recipientMessage->getCreatedAt()->format('d.m H:i'); ?></p>
                <p><?= htmlspecialchars($recipientMessage->getContent()); ?></p>
            <?php } ?>
        </div>
        <div id="new-message-section">
            <form method="POST" action="index.php?route=send-message&recipient_id=<?= $recipient->getId(); ?>">
                <textarea id="message_content" name="message_content" placeholder="Écrire un message..." required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
        <?php } else { ?>
            <p>Sélectionnez une conversation pour afficher les messages.</p>
        <?php } ?>
    </section> 
</section>

<?php
$pageContent = ob_get_clean();