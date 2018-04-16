<?php
session_start();
require_once "connection/MySQL.php";
$stmt = MySQL::getConnection()->prepare("SELECT id,token FROM users WHERE token = :token AND email = :email");
$stmt->execute([
    'token' => $_SESSION['token'],
    'email' => $_SESSION['email']
]);
if ($stmt->rowCount() == 0) {
    die("Account niet gevonden");
}

$stmt = MySQL::getConnection()->prepare("UPDATE users SET wachtwoord = :wachtwoord, token = NULL WHERE token = :token AND email = :email");
$stmt->execute([
    'wachtwoord' => password_hash($_POST['wachtwoord'], PASSWORD_BCRYPT),
    'token' => $_SESSION['token'],
    'email' => $_SESSION['email']
]);
session_destroy();
echo "Password is aangepast <br>";
echo "<a href='index.php'>Home</a>";