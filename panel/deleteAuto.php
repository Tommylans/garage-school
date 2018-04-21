<?php
session_start();
require_once __DIR__ . "/../managers/UserManager.php";
require_once __DIR__ . "/../managers/AutoManager.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
    exit();
} else {
    if (isset($_GET['id'])) {
        AutoManager::deleteAutoById($_GET['id']);
        header('Location: gebruikersBeheer.php');
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>