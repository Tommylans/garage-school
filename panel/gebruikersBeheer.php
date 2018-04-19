<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
require_once __DIR__ . "/../controllers/AutoManager.php";
if (!UserManager::isLoggedin()) {
    header("Location: /index.php");
    exit();
}
$user = UserManager::getUserById($_SESSION['id']);
if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Gebruiker Beheer</title>
</head>
<body>
<main>
    <div class="container">
        <h2 style="margin: 1rem">Alle gebruikers</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">klantId</th>
                <th scope="col">Gebruikersnaam</th>
                <th scope="col">Rol</th>
                <th scope="col">Email</th>
                <th scope="col">Aantal auto's</th>
                <th scope="col">Aanpassen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (UserManager::all() as $userLoop) { ?>
                <tr>
                    <th scope="row"><?php echo $userLoop->id ?></th>
                    <td><?php echo $userLoop->username ?></td>
                    <td><?php echo $userLoop->getRole() ?></td>
                    <td><?php echo $userLoop->email ?></td>
                    <td><?php echo count($userLoop->getAutos()) ?></td>
                    <td><a href="editUser.php?id=<?php echo $userLoop->id ?>">Aanpassen</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
</body>
</html>