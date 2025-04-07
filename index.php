<?php
require_once 'config/autoload.php';
require_once 'config/config.php';
FlashService::init();

try {
    $route = isset($_REQUEST['route']) ? $_REQUEST['route'] : 'home';


    switch ($route) {
        case 'home':
            // $userManager = new UserManager();
            // var_dump($userManager->findById(1));
            // $userData = $userManager->findById(1);
            // var_dump($userData);
            // $user = new User($userData);
            // var_dump($user);

            $controller = new MainController();
            $controller->homePage();
            break;
        case 'about':
            require_once 'src/view/about.php';
            require_once 'src/view/main.php';
            break;
        default:
            throw new Exception("Route $route does not exist");
    }
} catch (Exception $e) {
    $errorMsg = "Error encountered: {$e->getMessage()}";
    RenderService::renderView('error', ['errorMsg' => $errorMsg]);
}