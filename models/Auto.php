<?php

namespace Garage\Models;

use Garage\Managers\UserManager;

require_once __DIR__ . "/../autoload.php";
class Auto
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