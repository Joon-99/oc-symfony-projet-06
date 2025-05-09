<?php
abstract class UserService {
    public static function userIsLoggedIn(): bool {
        return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
    }

    public static function getCurrentUser(): ?User {
        $currentUserId = isset($_SESSION['currentUserId']) ? $_SESSION['currentUserId'] : null;
        if ($currentUserId) {
            $userManager = new UserManager();
            return $userManager->findById($currentUserId);
        }
        return null;
    }

    public static function isAdmin(User | int $user): bool {
        if (is_int($user)) {
            $userManager = new UserManager();
            $user = $userManager->findById($user);
        }
        return $user && in_array($user->getId(), ADMIN_IDS, true);
    }
}