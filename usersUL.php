<?php
session_start();
require_once "controllers/User.php";
if (isset($_SESSION['user'])) {
    if (!unserialize($_SESSION['user'])->isAdmin())
        die("Je hebt niet genoeg rechten voor deze website");
} else {
    die("Je bent niet ingelogt");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User list</title>
</head>
<body>
<ul>
    <?php
    foreach (User::All() as $user) {
        echo "<li> $user->username </li>";
    }
    ?>
</ul>
</body>
</html>