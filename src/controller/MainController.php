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
}