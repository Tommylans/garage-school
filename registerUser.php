<?php

use Garage\Managers\UserManager;

require_once "autoload.php";
if (UserManager::getUserByEmail($_POST['email']) == false) {
    if (isset($_POST['password'])) {
        UserManager::createUser(
            $_POST['username'],
            $_POST['adres'],
            $_POST['postcode'],
            $_POST['plaats'],
            $_POST['email'],
            $_POST['password']
        );
        echo $_POST['username'] . " is aangemaakt";
        header("Location: /index.php");
        exit();
    }
} else {
    echo "Er is al een account aangemaakt op: " . $_POST['email'];
}