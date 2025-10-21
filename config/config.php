<?php
    session_start();

    const DB_HOST = 'localhost';
    const DB_NAME = 'tomtroc';
    const DB_USER = 'root';
    const DB_PWD = '';

    const VIEW_PATH = 'src/view';
    const DATA_IMAGES_PATH = 'data/images/books/';

    const CONSTRAINT_USERNAME_REGEX = '/^[a-zA-Z0-9.-_]{3,20}$/';
    const CONSTRAINT_USERNAME_DESCRIPTION = "Le pseudo doit contenir entre 3 et 20 caractères, les caractères suivants sont autorisés : <br>" .
                                            "- Lettres majuscules et minuscules <br>" .
                                            "- Chiffres <br>" .
                                            "- Les caractères spéciaux suivants : . - _<br>";

    const CONSTRAINT_PASSWORD_REGEX = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
    const CONSTRAINT_PASSWORD_DESCRIPTION = "Le mot de passe doit contenir au moins 12 caractères, une majuscule, un chiffre et un caractère spécial.";

    const CONSTRAINT_BOOK_TITLE_REGEX = '/^[\p{L}\p{N}\s\p{P}]{1,255}$/u';
    const CONSTRAINT_BOOK_TITLE_DESCRIPTION = "Le titre du livre doit contenir entre 1 et 255 caractères";

    const CONSTRAINT_BOOK_DESCRIPTION_REGEX = '/^[\p{L}\p{N}\s\p{P}]{0,16000}$/u';
    const CONSTRAINT_BOOK_DESCRIPTION_DESCRIPTION = "La description du livre ne peut pas dépasser 16000 caractères.";

    const CONSTRAINT_FILE_SIZE_MB = 10; // Max file size in MB

    const DEFAULT_PROFILE_IMG_ID = 7; // Default profile image id
    const ADMIN_IDS = [1]; // IDs of all admin users