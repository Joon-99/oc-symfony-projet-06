<?php
/** @var User $convoRecipient */
/** @var Message $convoLastMessage */
?>
<a class="flex-row <?= $cardSectionClass; ?> convo-card" href="index.php?route=messages&recipient_id=<?= $convoRecipient->getId(); ?>" class="flex-row">
        <div class="convo-card-img-section">
            <img src="<?= $convoRecipient->getProfileImg()->getUserProfilePath(); ?>" alt="avatar du destinataire" class="convo-card-img">
        </div>
        <div class="flex-column convo-card-data">
            <div class="flex-row convo-card-metadata">
                <p class="convo-summary-txt"><?= htmlspecialchars($convoRecipient->getUsername()); ?></p>
                <p class="convo-summary-txt"><?= htmlspecialchars($convoLastMessage->getCreatedAt()->format('H:i')); ?></p>
            </div>
            <p><?= htmlspecialchars($convoLastMessage->getAbbreviatedContent()); ?></p>
        </div>
</a>