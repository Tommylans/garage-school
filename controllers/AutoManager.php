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
     * @param $kenteken
     * @return Auto
     */
    public static function getAutoById($id)
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM auto WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('Auto');
    }

    /**
     * @return Auto[]
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

    /**
     * @param $kenteken
     * @return bool
     */
    public static function deleteAutoById($kenteken)
    {
        $stmt = MySQL::getConnection()->prepare("DELETE FROM auto WHERE id = ?");
        return $stmt->execute([$kenteken]);
    }

    /**
     * @param $id
     * @param $kenteken
     * @param $merk
     * @param $type
     * @param $kmstand
     * @param $klantid
     * @return bool
     */
    public static function updateAuto($id, $kenteken, $merk, $type, $kmstand, $klantid)
    {
        $stmt = MySQL::getConnection()->prepare("UPDATE auto SET kenteken = :kenteken, merk = :merk, type = :type, kmstand = :kmstand, klantid = :klantid WHERE id = :id");
        return $stmt->execute([
            'kenteken' => $kenteken,
            'merk' => $merk,
            'type' => $type,
            'kmstand' => $kmstand,
            'klantid' => $klantid,
            'id' => $id
        ]);
    }
}