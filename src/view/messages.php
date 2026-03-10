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
            foreach ($conversations as $conversation) {
                $cardSectionClass = $recipient->getId() === $conversation['user']->getId() ? 'white-section' : 'dark-section';
                $convoRecipient = $conversation['user'];
                $convoLastMessage = $conversation['last_message'];
                require VIEW_PATH . '/convo-card.php';
            }
        } else { ?>
            <p>Aucune conversation disponible.</p>
        <?php } ?>
    </section> 
    <section id="conversation" class="dark-section flex-column">
        <?php if ($recipient !== null) { ?>
            <div id="recipient-info" class="flex-row">
                <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="avatar du destinataire" class="messagerie-avatar messagerie-avatar-large">
                <p><?= htmlspecialchars($recipient->getUsername()); ?></p>
            </div>
            <div id="messages" class="flex-column">
                <?php foreach ($recipientMessages as $recipientMessage) {
                    $isMsgFromCurrentUser = $recipientMessage->getSenderId() === \App\Service\UserService::getCurrentUser()->getId();
                    $msgStyleClass = $isMsgFromCurrentUser ? 'msg-card-sent' : 'msg-card-received';
                    $msgPositionClass = $isMsgFromCurrentUser ? 'align-self-end' : 'align-self-start';
                    /** @var Message $recipientMessage */ ?>
                    <div class="flex-column msg-card">
                        <div class="flex-row msg-card-metadata <?= $msgPositionClass ?>">
                            <?php if (!$isMsgFromCurrentUser) { ?>
                                <img src="<?= $recipient->getProfileImg()->getUserProfilePath(); ?>" alt="avatar du destinataire" class="messagerie-avatar messagerie-avatar-small">
                            <?php } ?>
                            <p><?= $recipientMessage->getCreatedAt()->format('d.m H:i'); ?></p>
                        </div>
                        <div class="flex-row msg-card-content msg-card-basic <?= $msgStyleClass; ?> <?= $msgPositionClass; ?>">
                            <p><?= htmlspecialchars($recipientMessage->getContent()); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="new-message-section" class="flex-row">
                <form class="flex-row" method="POST" action="index.php?route=send-message&recipient_id=<?= $recipient->getId(); ?>">
                    <input id="message_content" name="message_content" placeholder="Tapez votre message ici" required>
                    <button class="green-cta-btn" type="submit">Envoyer</button>
                </form>
            </div>
        <?php } else { ?>
            <p>Sélectionnez une conversation pour afficher les messages.</p>
        <?php } ?>
    </section> 
</section>

<?php
$pageContent = ob_get_clean();
