<?php
/** @var User $convoRecipient */
/** @var Message $convoLastMessage */
?>
<a class="flex-row <?= $cardSectionClass; ?>" href="index.php?route=messages&recipient_id=<?= $convoRecipient->getId(); ?>" class="flex-row" id="convo-card-link">
        <div id="convo-card-img">
            <img src="<?= $convoRecipient->getProfileImg()->getUserProfilePath(); ?>" alt="Profile Image" width="50" height="50">
        </div>
        <div id="convo-card-data" class="flex-column">
            <div class="flex-row">
                <p><?= htmlspecialchars($convoRecipient->getUsername()); ?></p>
                <p><?= htmlspecialchars($convoLastMessage->getCreatedAt()->format('H:i')); ?></p>
            </div>
            <p><?= htmlspecialchars($convoLastMessage->getAbbreviatedContent()); ?></p>
        </div>
</a>