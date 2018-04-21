<?php

class MySQL
{

    private static $connection;

    /**
     * @return null|PDO
     */
    public static function getConnection()
    {
        if (isset(self::$connection)) {
            return self::$connection;
        }
        $config = require __DIR__ . "/../config.php";

        try {
            self::$connection = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
            return self::$connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
