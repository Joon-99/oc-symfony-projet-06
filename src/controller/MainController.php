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
}