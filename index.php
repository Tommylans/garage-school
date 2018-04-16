<?php
session_start();
require_once "controllers/User.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
<form action="register.php" method="post">
    <h1>register</h1>
    Naam: <input type="text" name="username"><br>
    Adres: <input type="text" name="adres"><br>
    Postcode: <input type="text" name="postcode"><br>
    Plaats: <input type="text" name="plaats"><br>
    Email: <input type="email" name="email"><br>
    Wachtwoord: <input type="password" name="wachtwoord"><br>
    <input type="submit"><br>
</form>
<?php
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    echo '<form action="login.php" method="post">
                <h1>Login</h1>
                Email: <input type="email" name="email"><br>
                Wachtwoord: <input type="password" name="wachtwoord"><br>
                <input type="submit"><br>
            </form>';
} else {
    echo '<a href="uitloggen.php">Uitloggen</a>';
}
?>

<form action="passwordforget.php" method="post">
    <h1>Password reset</h1>
    Email: <input type="email" name="email">
    <input type="submit">
</form>

<?php
if (isset($_SESSION['user']))
    if (unserialize($_SESSION['user'])->isAdmin())
        echo '<a href="usersUL.php">Alle users (ADMIN)</a>';
?>
</body>
</html>