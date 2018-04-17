<?php
require_once "AutoManager.php";

class User
{
    var $id,
        $email,
        $username,
        $postcode,
        $adres,
        $plaats;

    /**
     * @return String
     */
    public function getRole()
    {
        $stmt = MySQL::getConnection()->prepare("SELECT level FROM rollen WHERE userid = :id");
        $stmt->execute([
            'id' => $this->id
        ]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchObject();
            return $result->level;
        }
        return null;
    }

    /**
     * @return array Auto
     */
    public function getAutos()
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM auto WHERE klantid = ?");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Auto');
    }
}