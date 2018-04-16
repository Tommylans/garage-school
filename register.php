<?php
require_once "Controllers/UserManager.php";
if (UserManager::getUserByEmail($_POST['email']) == false) {
    if (isset($_POST['wachtwoord'])) {
        UserManager::createUser(
            $_POST['username'],
            $_POST['adres'],
            $_POST['postcode'],
            $_POST['plaats'],
            $_POST['email'],
            $_POST['wachtwoord']
        );
        echo $_POST['username'] . " is aangemaakt";
    }
} else {
    echo "Er is al een account aangemaakt op: " . $_POST['email'];
}