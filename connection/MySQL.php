<?php

class MySQL
{

    private static $connection;

    /**
     * @return null|PDO
     */
    public static function getConnection()
    {
        if (isset(self::$connection))
            return self::$connection;

        $user = "root";
        $password = "";
        $database = "garage";

        try {
            self::$connection = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
            return self::$connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
