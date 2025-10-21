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
    public static function checkBookTitle(string $title): bool {
        return preg_match(CONSTRAINT_BOOK_TITLE_REGEX, $title);
    }
    public static function checkAuthor(string $authorId): bool {
        if (!filter_var($authorId, FILTER_VALIDATE_INT)) {
            return false;
        }
        $authorManager = new AuthorManager();
        return $authorManager->findById($authorId) !== null;
    }
    public static function checkBookDescription(string $description): bool {
        return preg_match(CONSTRAINT_BOOK_DESCRIPTION_REGEX, $description);
    }
    public static function checkBookAvailability(string $available): bool {
        return in_array($available, ['0', '1'], true);
    }
    public static function checkCoverImage(array $coverImgFile): bool {
        if ($coverImgFile['error'] === UPLOAD_ERR_NO_FILE) {
            // No file uploaded, which is acceptable
            return true;
        }
        if ($coverImgFile['error'] !== UPLOAD_ERR_OK) {
            FlashService::addMessage('error', "Erreur lors du téléchargement de l'image de couverture.");
            return false;
        }
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($coverImgFile['type'], $allowedMimeTypes, true)) {
            FlashService::addMessage('error', "Le type de fichier de l'image de couverture n'est pas autorisé. Types autorisés : JPEG, PNG, GIF.");
            return false;
        }
        $maxFileSize = CONSTRAINT_FILE_SIZE_MB * 1024 * 1024;
        if ($coverImgFile['size'] > $maxFileSize) {
            FlashService::addMessage('error', "La taille de l'image de couverture dépasse la limite autorisée de " . CONSTRAINT_FILE_SIZE_MB . " Mo.");
            return false;
        }
        return true;
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

    public static function checkBookData(array $bookData): bool {
        $isValid = true;
        if (!self::checkBookTitle($bookData['title'])) {
            FlashService::addMessage('error', CONSTRAINT_BOOK_TITLE_DESCRIPTION, 'raw');
            $isValid = false;
        }
        if (!self::checkAuthor($bookData['author'])) {
            FlashService::addMessage('error', "L'auteur sélectionné n'existe pas.");
            $isValid = false;
        }
        if (!self::checkBookDescription($bookData['description'])) {
            FlashService::addMessage('error', CONSTRAINT_BOOK_DESCRIPTION_DESCRIPTION, 'raw');
            $isValid = false;
        }
        if (!self::checkBookAvailability($bookData['available'])) {
            FlashService::addMessage('error', "La disponibilité du livre est invalide.");
            $isValid = false;
        }
        if (!self::checkCoverImage($bookData['coverImgFile'])) {
            $isValid = false;
        }
        return $isValid;
    }
}