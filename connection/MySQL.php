<?php
class MySQL {
    /**
     * @return null|PDO
     */
    public static function getConnection()
    {
        $user = "root";
        $password = "";
        $database = "garage";

        try {
            return new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
