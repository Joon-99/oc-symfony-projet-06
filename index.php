<?php
require_once 'config/autoload.php';
require_once 'config/config.php';
FlashService::init();

try {
    $route = isset($_REQUEST['route']) ? $_REQUEST['route'] : 'home';

    switch ($route) {
        case 'home':
            $controller = new MainController();
            $controller->homePage();
            break;
        case 'books':
            $controller = new MainController();
            $controller->booksAvailable();
            break;
        case 'search-book':
            $searchText = isset($_GET['search-book']) ? $_GET['search-book'] : null;
            $controller = new MainController();
            $controller->booksAvailable($searchText);   
            break;
        case 'book-details':
            $controller = new MainController();
            $bookId = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$bookId) {
                throw new Exception("You need a book id to access this route.");
            }
            $controller->bookDetails($bookId);
        case 'sign-up':
            $controller = new MainController();
            $controller->signUpPage();
            break;
        case 'login':
            $controller = new MainController();
            $controller->loginPage();
            break;
        case 'logout':
            $controller = new MainController();
            $controller->logout();
            break;
        case 'my-profile':
            $controller = new MainController();
            $controller->myProfilePage();
            break;
        case 'external-profile':
            $controller = new MainController();
            $userId = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$userId) {
                throw new Exception("You need a user id to access this route.");
            }
            $controller->externalProfilePage($userId);
            break;
        case 'delete-book':
            $controller = new MainController();
            $bookId = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$bookId) {
                throw new Exception("You need a book id to access this route.");
            }
            if (!UserService::userIsLoggedIn()) {
                throw new Exception("You need to be logged in to access this route.");
            }
            $user = UserService::getCurrentUser();
            $controller->deleteBook($user, $bookId);
            break;
        case 'edit-book':
            $controller = new MainController();
            $bookId = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$bookId) {
                throw new Exception("You need a book id to access this route.");
            }
            if (!UserService::userIsLoggedIn()) {
                $controller->loginPage();
            } else {
                $user = UserService::getCurrentUser();
                $controller->editBook($user, $bookId);
            }
            break;
        case 'messages':
            $controller = new MainController();
            $recipientId = isset($_GET['recipient_id']) ? $_GET['recipient_id'] : null;
            if (!UserService::userIsLoggedIn()) {
                $controller->loginPage();
            } else {
                $user = UserService::getCurrentUser();
                $controller->messagesPage($user, $recipientId);
            }
            break;
        default:
            throw new Exception("Route $route does not exist");
    }
} catch (Exception $e) {
    $errorMsg = "Error encountered: {$e->getMessage()}";
    RenderService::renderView('error', ['errorMsg' => $errorMsg]);
}