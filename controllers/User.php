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
    private $role;

    /**
     * @return String
     */
    public function getRole()
    {
        if (!isset($this->role)) {
            $stmt = MySQL::getConnection()->prepare("SELECT level FROM rollen WHERE userid = :id");
            $stmt->execute([
                'id' => $this->id
            ]);
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchObject();
                $this->role = $result->level;
                return $result->level;
            }
            return null;
        } else {
            return $this->role;
        }
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        switch ($this->getRole()) {
            case "Klant";
                return 1;
            case "Monteur":
                return 2;
            case "Directie":
                return 3;
            case "Planner":
                return 5;
            case "Systeembeheerder":
                return 6;
            default:
                return -1;
        }
    }

    /**
     * @return Auto[]
     */
    public function getAutos()
    {
        $stmt = MySQL::getConnection()->prepare("SELECT * FROM auto WHERE klantid = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Auto');
    }
}