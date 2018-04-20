<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
require_once __DIR__ . "/../controllers/AutoManager.php";
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