<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
} else {
    if (isset($_POST['userid'])) {
        UserManager::updateUser($_POST['userid'], $_POST['username'], $_POST['email'], $_POST['adres'], $_POST['plaats'], $_POST['postcode']);
        header('Location: gebruikersBeheer.php');
    } else {
        header("Location: index.php");
    }
}
?>