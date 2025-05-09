<?php
abstract class FormService {

    public static function checkUserName(string $userName): bool {
        return preg_match(CONSTRAINT_USERNAME_REGEX, $userName);
    }
    public static function checkUserEmail(string $userEmail): bool {
        return filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    }
    public static function checkUserPassword(string $userPassword): bool {
        return preg_match(CONSTRAINT_PASSWORD_REGEX, $userPassword);
    }

    public static function checkUserSignUpData(array $UserData): bool {
        $isValid = true;
        if (!preg_match(CONSTRAINT_USERNAME_REGEX, $UserData['username'])) {
            FlashService::addMessage('error', CONSTRAINT_USERNAME_DESCRIPTION, 'raw');
            $isValid = false;
        }
        if (!filter_var($UserData['email'], FILTER_VALIDATE_EMAIL)) {
            FlashService::addMessage('error', "L'email que vous avez renseigné n'est pas une adresse email valide.");
            $isValid = false;
        }
        if (!preg_match(CONSTRAINT_PASSWORD_REGEX, $UserData['password'])) {
            FlashService::addMessage('error', CONSTRAINT_PASSWORD_DESCRIPTION);
            $isValid = false;
        }
        return $isValid;
    }
}