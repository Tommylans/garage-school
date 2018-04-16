<?php

require_once "UserManager.php";
class auto
{
    var $kenteken,
        $klantid,
        $merk,
        $type,
        $kmafstand;

    /**
     * @return User
     */
    public function getEigenaar() {
        return UserManager::getUserById($this->klantid);
    }
}