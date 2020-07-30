<?php

use app\User;

session_start();

$dir = realpath(__DIR__ . '/../');
spl_autoload_register(function ($class_name) use ($dir) {
    $file = $dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$data = $_POST;

if ($data) {
    if (isset($data['signup'])) {
        $user = new User();
    }
}

require_once '../views/register.php';
