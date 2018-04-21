<?php
session_start();
require_once __DIR__ . "/../managers/UserManager.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
    exit();
} else {
    if (isset($_GET['id'])) {
        UserManager::deleteUser($_GET['id']);
        header('Location: gebruikersBeheer.php');
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>