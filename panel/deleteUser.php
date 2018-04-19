<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
} else {
    if (isset($_GET['id'])) {
        UserManager::deleteUser($_GET['id']);
        header('Location: gebruikersBeheer.php');
    } else {
        header("Location: index.php");
    }
}
?>