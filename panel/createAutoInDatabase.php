<?php

use Garage\Managers\AutoManager;
use Garage\Managers\UserManager;

session_start();
require_once __DIR__ . "/../autoload.php";
if (!UserManager::isLoggedin()) {
    header("Location: /index.php");
    exit();
}
$user = UserManager::getUserById($_SESSION['id']);
if (!$user->getLevel() >= 3) {
    header("Location: index.php");
    exit();
}
AutoManager::createAuto(strtoupper($_POST['kenteken']), $_POST['merk'], $_POST['type'], $_POST['kmstand'], $_POST['eigenaarid']);
header("Location: index.php");
exit();
