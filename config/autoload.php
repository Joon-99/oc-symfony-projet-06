<?php

spl_autoload_register(function($className) {
    $sourceFolder = "src/";
    $sourceSubFolders = [
        "controller/",
        "service/",
        "view/",
        "entity/",
        "manager/",
    ];
    foreach ($sourceSubFolders as $subFolder) {
        $classPath = "{$sourceFolder}{$subFolder}{$className}.php";
        if (file_exists($classPath)) {
            require_once $classPath;
        }
    }
});