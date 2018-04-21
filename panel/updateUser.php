<?php

use Garage\Managers\UserManager;

session_start();
require_once __DIR__ . "/../autoload.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
    exit();
} else {
    if (isset($_POST['userid'])) {
        UserManager::updateUser($_POST['userid'], $_POST['username'], $_POST['email'], $_POST['adres'], $_POST['plaats'], $_POST['postcode'], $_POST['rol']);
        header('Location: gebruikersBeheer.php');
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>