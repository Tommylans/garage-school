<?php

require_once __DIR__ .  "/../managers/UserManager.php";

class auto
{
    var $id,
        $kenteken,
        $klantid,
        $merk,
        $type,
        $kmStand;

    /**
     * @return User
     */
    public function getEigenaar()
    {
        return UserManager::getUserById($this->klantid);
    }
}