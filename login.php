<?php
session_start();
require_once "connection/MySQL.php";
require_once "controllers/UserManager.php";
$stmt = MySQL::getConnection()->prepare("SELECT id,username,wachtwoord,email FROM users WHERE email = :email");
$stmt->execute([
    'email' => $_POST['email'],
]);

$results = $stmt->fetch(PDO::FETCH_OBJ);

if (password_verify($_POST["wachtwoord"], $results->wachtwoord)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = serialize(UserManager::getUserByEmail($results->email));
    session_commit();
    echo "Je bent ingelogt";
} else {
    echo "Je password is fout";
}
echo '<br><a href="index.php">Terug naar hoofd menu</a>';
