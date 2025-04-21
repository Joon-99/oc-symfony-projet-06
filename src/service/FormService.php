<?php
abstract class FormService {
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