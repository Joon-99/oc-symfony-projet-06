<?php
class FlashService {
    private const SESSION_KEY = 'flash_messages';
    private const FLASH_TYPES = ['error', 'warning', 'success', 'info'];

    /**
     * Initializes the flash message system.
     * Should be called at the beginning of the application.
     */
    public static function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }
    }
    public static function hasMessages(): bool {
        return isset($_SESSION[self::SESSION_KEY]) && !empty($_SESSION[self::SESSION_KEY]);
    }
    public static function getMessages(): array {
        if (self::hasMessages()) {
            return $_SESSION[self::SESSION_KEY];
        }
        return [];
    }
    public static function addMessage(string $type, string $msg, string $raw = ''): void {
        if (!$raw) {
            $msg = htmlspecialchars($msg);
        }
        $_SESSION[self::SESSION_KEY][] = [
            'type' => $type,
            'msg' => $msg,
        ];

    }
    public static function removeLastMessage(): bool {
        if (!self::hasMessages()) {
            return false;
        }
        
        array_pop($_SESSION[self::SESSION_KEY]);
        return true;
    }

    public static function clearMessages(): void {
        $_SESSION[self::SESSION_KEY] = [];
    }
    public static function getLastMessage(): ?array {
        if (!self::hasMessages()) {
            return null;
        }
        
        return end($_SESSION[self::SESSION_KEY]);
    }
    public static function getFirstMessage(): ?array {
        if (!self::hasMessages()) {
            return null;
        }
        
        return reset($_SESSION[self::SESSION_KEY]);
    }

    public static function getMessagesByType(string $type): array {
        if (self::hasMessages()) {
            return array_filter($_SESSION[self::SESSION_KEY], function($message) use ($type) {
                return $message['type'] === $type;
            });
        }
        return [];
    }

}