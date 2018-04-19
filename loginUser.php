<?php
session_start();
require_once "controllers/UserManager.php";
if ($user = UserManager::login($_POST['email'], $_POST['password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $user->id;
    $_SESSION['email'] = $user->email;
    session_commit();
    echo "Je bent ingelogt";
    header("Location: panel/index.php");
} else {
    echo "Je password is fout";
    $_SESSION['message'] = "Password is fout";
}