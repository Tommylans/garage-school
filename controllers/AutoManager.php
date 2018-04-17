<?php
require_once __DIR__ . "/../connection/MySQL.php";
require_once "Auto.php";

class AutoManager
{
    /**
     * @param $kenteken
     * @return Auto
     */
    public static function getAutoByKenteken($kenteken)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM auto WHERE kenteken = ?");
        $stmt->execute([$kenteken]);
        return $stmt->fetchObject('Auto');
    }

    /**
     * @return array
     */
    public static function all()
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM auto");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Auto');
    }

    /**
     * @param $kenteken
     * @param $merk
     * @param $type
     * @param $kmAfstand
     * @param $klantid
     * @return bool
     */
    public static function createAuto($kenteken, $merk, $type, $kmAfstand, $klantid)
    {
        $stmt = MySQL::getConnection()->prepare("INSERT INTO auto (kenteken, merk, type, kmStand, klantid) VALUES (?,?,?,?,?)");
        return $stmt->execute([
            $kenteken,
            $merk,
            $type,
            $kmAfstand,
            $klantid
        ]);
    }

    /**
     * @param $kenteken
     * @return bool
     */
    public static function deleteAutoByKenteken($kenteken)
    {
        $stmt = MySQL::getConnection()->prepare("DELETE FROM auto WHERE kenteken = ?");
        return $stmt->execute([$kenteken]);
    }
}