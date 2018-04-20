<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
    exit();
} else {
    if (isset($_POST['autoid'])) {
        AutoManager::updateAuto($_POST['autoid'], $_POST['kenteken'], $_POST['merk'], $_POST['type'], $_POST['kmstand'], $_POST['eigenaarid']);
        header('Location: index.php');
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>