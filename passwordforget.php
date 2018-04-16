<?php
$token = md5($_POST['email'] . rand(100, 99999) . time());
$email = $_POST['email'];
require_once "connection/MySQL.php";
$stmt = MySQL::getConnection()->prepare("UPDATE users SET token = :token WHERE email = :email");
$stmt->execute([
    'token' => $token,
    'email' => $email,
]);
if ($stmt->rowCount() == 1) {
    echo "<a href='recover.php?token=EXTERNAL_FRAGMENT&email=EXTERNAL_FRAGMENT'>url uit email</a>$token$email";
}
