<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
require_once __DIR__ . "/../controllers/AutoManager.php";
if (!UserManager::isLoggedin()) {
    header("Location: /index.php");
    exit();
}
$user = UserManager::getUserById($_SESSION['id']);
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
    <title>Panel</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Garage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if ($user->getRole() === "Planner" || $user->getRole() === "Systeembeheerder") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="gebruikersBeheer.php">Gebruikers beheer</a>
                    </li>
                <?php } ?>
                <?php if ($user->getRole() === "Directie" || $user->getRole() === "Monteur") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="">Verander profiel</a>
                    </li>
                <?php } ?>
            </ul>
            <p><?php $user->username ?></p>
            <a href="/uitloggen.php">Uitloggen</a>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <?php if ($user->getRole() === "Klant") { ?>
            <h2 style="margin: 1rem">Jou auto's</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Kenteken</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Type</th>
                    <th scope="col">Km Stand</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($user->getAutos() as $auto) { ?>
                    <tr>
                        <th scope="row"><?php echo $auto->kenteken ?></th>
                        <td><?php echo $auto->merk ?></td>
                        <td><?php echo $auto->type ?></td>
                        <td><?php echo $auto->kmStand ?> km</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else if ($user->getLevel() > 1) { ?>
            <h2 style="margin: 1rem">Alle autos</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Kenteken</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Type</th>
                    <th scope="col">Km Stand</th>
                    <th scope="col">Eigenaar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (AutoManager::all() as $auto) { ?>
                    <tr>
                        <th scope="row"><?php echo $auto->kenteken ?></th>
                        <td><?php echo $auto->merk ?></td>
                        <td><?php echo $auto->type ?></td>
                        <td><?php echo $auto->kmStand ?> km</td>
                        <td><?php echo $auto->getEigenaar()->email ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
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