<?php
$messageIcons = [
    'error' => 'fa-triangle-exclamation',
    'warning' => 'fa-exclamation',
    'success' => 'fa-check',
];

$messagePrefixes = [
    'error' => 'ERREUR : ',
    'warning' => 'ATTENTION : ',
    'success' => 'Succès : ',
];

foreach ($flashMessages as $flashMessage) {
    $iconClass = $messageIcons[$flashMessage['type']];
    $faIcon = '<i class="fa-solid ' . $iconClass . ' '. $flashMessage['type'] . '"></i>';
    $message = $messagePrefixes[$flashMessage['type']] . $flashMessage['msg'];
    echo '<div class="flash-message ' . $flashMessage['type'] . '">' . $faIcon . $message . '</div>';
}
FlashService::clearMessages();
