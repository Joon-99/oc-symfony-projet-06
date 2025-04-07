<?php
class RenderService {
    public static function renderView(string $viewName, array $params): void {
        $viewPath = VIEW_PATH;
        extract($params);
        require_once "$viewPath/$viewName.php";
        require_once "$viewPath/main.php";
    }
}