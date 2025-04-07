<?php
class RenderService {
    public static function renderView(string $viewName, array $params): void {
        $params = array_merge($params, [
            'flashMessages' => FlashService::getMessages(),
        ]);
        $viewPath = VIEW_PATH;
        extract($params);
        require_once "$viewPath/$viewName.php";
        require_once "$viewPath/main.php";
    }
}