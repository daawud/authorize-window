<?php


namespace app;


use PDO;

class Db
{
    protected static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (self::$_instance === null) {
            $dsn = "mysql:host=192.168.88.77;dbname=dev";
            self::$_instance = new PDO($dsn, 'dev', 'dev');
        }

        return self::$_instance;
    }

    private function __clone() {

    }

    private function __wakeup() {

    }
}