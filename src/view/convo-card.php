<?php

/** @var User $convoRecipient */
/** @var Message $convoLastMessage */
?>
<a class="flex-row <?= $cardSectionClass; ?> convo-card"
href="index.php?route=messages&recipient_id=<?= $convoRecipient->getId(); ?>">
        <div class="convo-card-img-section">
            <img src="<?= $convoRecipient->getProfileImg()->getUserProfilePath(); ?>"
            alt="avatar du destinataire" class="messagerie-avatar messagerie-avatar-large">
        </div>
        <div class="flex-column convo-card-data">
            <div class="flex-row convo-card-metadata">
                <p><?= htmlspecialchars($convoRecipient->getUsername()); ?></p>
                <p><?= htmlspecialchars($convoLastMessage->getCreatedAt()->format('H:i')); ?></p>
            </div>
            <p class="convo-summary-txt"><?= htmlspecialchars($convoLastMessage->getAbbreviatedContent()); ?></p>
        </div>
</a>