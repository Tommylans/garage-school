<?php

use Garage\Managers\UserManager;

require_once "autoload.php";
session_start();
if ($user = UserManager::login($_POST['email'], $_POST['password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $user->id;
    $_SESSION['email'] = $user->email;
    session_commit();
    echo "Je bent ingelogt";
    header("Location: panel/index.php");
    exit();
} else {
    echo "Je password is fout";
    $_SESSION['message'] = "Password is fout";
}