<?php

class MainController {
    public function homePage(): void {
        $userManager = new UserManager();
        $users = $userManager->findAll();
        $userU = $userManager->findById(1);
        RenderService::renderView('home', [
            'users' => $users,
            'userU' => $userU,
        ]);
    }

    public function booksAvailable(?string $searchText = null): void {
        $bookManager = new BookManager();
        if ($searchText) {
            $books = $bookManager->findByText($searchText);
            if (!$books) {
                FlashService::addMessage('warning', "Aucun livre trouvé pour la recherche : $searchText");
            }
        } else {
            $books = $bookManager->findAll();
        }
        RenderService::renderView('books', [
            'searchText' => $searchText,
            'books' => $books,
        ]);
    }

    public function bookDetails(int $bookId): void {
        $bookManager = new BookManager();
        $fileManager = new FileManager();
        $book = $bookManager->findById($bookId);
        if (!$book) {
            RenderService::renderView('error', ['errorMsg' => "Aucun livre trouvé avec l'ID : $bookId"]);
            return;
        }
        $ownerImage = $fileManager->findById($book->getOwner()->getProfileImgId());
        $ownerImage = $ownerImage ? $ownerImage->getFilePath() : null;
        RenderService::renderView('book-details', [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'img' => $book->getCoverImg()->getFilePath(),
            'author' => $book->getAuthor()->getFullName(),
            'description' => $book->getDescription(),
            'ownerUsername' => $book->getOwner()->getUsername(),
            'ownerImage' => $ownerImage,
        ]);
    }

    public function signUpPage(): void {
        if (isset($_POST['submit'])) {
            $userManager = new UserManager();
            $userLogin = $_POST['username'];
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            $isValidUserData = FormService::checkUserSignUpData([
                'username' => $userLogin,
                'email' => $userEmail,
                'password' => $userPassword,
            ]);
            $user = $userManager->findByUsername($userLogin);
            if ($user) {
                FlashService::addMessage('error', "Le pseudo $userLogin est déjà utilisé.");
                $isValidUserData = false;
            }
            $user = $userManager->findByEmail($userEmail);
            if ($user) {
                FlashService::addMessage('error', "L'email $userEmail est déjà utilisé.");
                $isValidUserData = false;
            }
            if (!$isValidUserData) {
                RenderService::renderView('sign-up', []);
                return;
            }
            try {
                $userManager->createUserFromData([
                    'username' => $userLogin,
                    'email' => $userEmail,
                    'password' => $userPassword,
                ]);
            } catch (Exception $e) {
                FlashService::addMessage('error', "Erreur lors de l'inscription : {$e->getMessage()}");
                RenderService::renderView('sign-up', []);
                return;
            }
            FlashService::addMessage('success', "Vous êtes inscrit avec succès ! Vous pouvez maintenant vous connecter.");

            header('Location: index.php?route=sign-up');
            return;
        }
        RenderService::renderView('sign-up', []);
    }

    public function loginPage(): void {
        if (isset($_POST['submit'])) {
            $userManager = new UserManager();
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];
            $user = $userManager->findByEmail($userEmail);
            if (!$user || !password_verify($userPassword, $user->getPasswordHash())) {
                FlashService::addMessage('error', "Le mot de passe et/ou l'adresse email est incorrect.");
                RenderService::renderView('login', []);
                return;
            }
            FlashService::addMessage('success', "Vous êtes maintenant connecté en tant que {$user->getUsername()} !");
            $_SESSION['loggedIn'] = true;
            $_SESSION['currentUserId'] = $user->getId();
            header('Location: index.php?route=home');
            return;
        }
        RenderService::renderView('login', []);
    }

    public function logout(): void {
        unset($_SESSION['loggedIn']);
        unset($_SESSION['currentUserId']);
        header('Location: index.php?route=home');
    }

    public function myProfilePage(): void {
        if (!UserService::userIsLoggedIn()) {
            UtilService::redirect('login');
        }
        $userManager = new UserManager();
        $bookManager = new BookManager();
        $user = $userManager->findById($_SESSION['currentUserId']);
        if (!$user) {
            throw new Exception("Utilisateur introuvable. Veuillez vous connecter.");
        }
        if (isset($_POST['submit'])) {
            $hasUpdates = false;
            $hasErrors = false;
            
            if (!empty($_POST['username']) && $_POST['username'] !== $user->getUsername()) {
                if (FormService::checkUserName($_POST['username'])) {
                    $user->setUsername($_POST['username']);
                    $hasUpdates = true;
                } else {
                    FlashService::addMessage('error', CONSTRAINT_USERNAME_DESCRIPTION, 'raw');
                    $hasErrors = true;
                }
            }
            
            if (!empty($_POST['email']) && $_POST['email'] !== $user->getEmail()) {
                if (FormService::checkUserEmail($_POST['email'])) {
                    $existingUser = $userManager->findByEmail($_POST['email']);
                    if ($existingUser && $existingUser->getId() !== $user->getId()) {
                        FlashService::addMessage('error', "Cette adresse email est déjà utilisée.");
                        $hasErrors = true;
                    } else {
                        $user->setEmail($_POST['email']);
                        $hasUpdates = true;
                    }
                } else {
                    FlashService::addMessage('error', "Format d'email invalide.");
                    $hasErrors = true;
                }
            }
            
            if (!empty($_POST['password'])) {
                if (FormService::checkUserPassword($_POST['password'])) {
                    $user->setPasswordHash(password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $hasUpdates = true;
                } else {
                    FlashService::addMessage('error', CONSTRAINT_PASSWORD_DESCRIPTION, 'raw');
                    $hasErrors = true;
                }
            }
            
            if ($hasUpdates && !$hasErrors) {
                try {
                    $userManager->updateUserEntity($user);
                    FlashService::addMessage('success', "Votre compte a été mis à jour !");
                } catch (Exception $e) {
                    FlashService::addMessage('error', "Erreur lors de la mise à jour du compte : {$e->getMessage()}");
                }
            } elseif (!$hasUpdates && !$hasErrors) {
                FlashService::addMessage('warning', "Aucune modification n'a été effectuée.");
            }
        }
        RenderService::renderView('my-profile', [
            'userName' => $user->getUsername(),
            'accountAge' => $user->getAccountAge()->format('%y ans'),
            'nbBooks' => $bookManager->getNbBooksFromUser($user->getId()),
            'imgProfilePath' => $user->getProfileImg() ? $user->getProfileImg()->getFilePath() : null,
            'userEmail' => $user->getEmail(),
            'userBooks' => $bookManager->findByOwner($user->getId()) ?? [],
            'externalAccount' => false,
        ]);
    }

    public function deleteBook(User $user, int $bookId): void {
        $bookManager = new BookManager();
        $book = $bookManager->findById($bookId);
        if (!$book) {
            FlashService::addMessage('error', "Livre introuvable.");
        } 
        else if ($book->getOwner()->getId() !== $user->getId() && !UserService::isAdmin($user)) {
            FlashService::addMessage('error', "Vous ne pouvez pas supprimer un livre qui ne vous appartient pas.");
        }
        else {
            try {
                $bookManager->deleteBook($book);
                FlashService::addMessage('success', "Livre supprimé avec succès !");
            } catch (Exception $e) {
                FlashService::addMessage('error', "Erreur lors de la suppression du livre : {$e->getMessage()}");
            }
        }
        header('Location: index.php?route=my-profile');
    }

    public function externalProfilePage(int $userId): void {
        $userManager = new UserManager();
        $bookManager = new BookManager();
        $user = $userManager->findById($userId);
        if (!$user) {
            throw new Exception("Pas de profil trouvé pour cet utilisateur.");
        }
        RenderService::renderView('external-profile', [
            'userName' => $user->getUsername(),
            'accountAge' => $user->getAccountAge()->format('%y ans'),
            'nbBooks' => $bookManager->getNbBooksFromUser($user->getId()),
            'imgProfilePath' => $user->getProfileImg() ? $user->getProfileImg()->getFilePath() : null,
            'userEmail' => $user->getEmail(),
            'userBooks' => $bookManager->findByOwner($user->getId()) ?? [],
            'externalAccount' => true,
        ]);
    }
}