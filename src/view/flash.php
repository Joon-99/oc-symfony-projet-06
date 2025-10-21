<?php
$messageIcons = [
    'error' => 'fa-triangle-exclamation',
    'warning' => 'fa-exclamation',
    'success' => 'fa-check',
    'info' => 'fa-info',
];

$messagePrefixes = [
    'error' => 'ERREUR : ',
    'warning' => 'ATTENTION : ',
    'success' => 'Succès : ',
    'info' => 'Info : ',
];

foreach ($flashMessages as $flashMessage) {
    $iconClass = $messageIcons[$flashMessage['type']];
    $faIcon = '<i class="fa-solid ' . $iconClass . ' '. $flashMessage['type'] . '"></i>';
    $message = $messagePrefixes[$flashMessage['type']] . $flashMessage['msg'];
    echo '<div class="flash-message ' . $flashMessage['type'] . '">' . $faIcon . "<p>$message</p>" . '</div>';
}
FlashService::clearMessages();
