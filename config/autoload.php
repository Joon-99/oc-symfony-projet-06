<?php

spl_autoload_register(function ($className) {

    // Namespace prefix => base directory
    $prefixes = [
        'App\\' => __DIR__ . '/../src/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);

        // If class does not start with prefix, skip
        if (strncmp($className, $prefix, $len) !== 0) {
            continue;
        }

        // Remove prefix: App\Entity\Author => Entity\Author
        $relativeClass = substr($className, $len);

        // Build file path: src/Entity/Author.php
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (is_file($file)) {
            require $file;
        }
    }
});
