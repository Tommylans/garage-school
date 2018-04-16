<?php
session_start();
require_once "connection/MySQL.php";
$email = $_GET['email'];
$token = $_GET['token'];
$stmt = $connection->prepare("SELECT id,token FROM users WHERE token = :token AND email = :email");
$stmt->execute([
    'email'=> $email,
    'token' => $token
]);
if ($stmt->rowCount() == 0) {
    die("Account niet gevonden");
}
$_SESSION['token'] = $token;
$_SESSION['email'] = $email;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password recover</title>
</head>
<body>
<form action="resetpassword.php" method="post">
    New password: <input type="password" name="wachtwoord">
    <input type="submit">
</form>
</body>
</html>