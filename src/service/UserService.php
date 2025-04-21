<?php
abstract class UserService {
    public static function userIsLoggedIn(): bool {
        return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
    }
}