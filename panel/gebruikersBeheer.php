<?php

use Garage\Managers\UserManager;

session_start();
require_once __DIR__ . "/../autoload.php";
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
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Garage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if ($user->getRole() === "Planner" || $user->getRole() === "Systeembeheerder") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="gebruikersBeheer.php">Gebruikers beheer <span class="sr-only">(current)</span></a>
                    </li>
                <?php } ?>
                <?php if ($user->getRole() === "Directie" || $user->getRole() === "Monteur") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="editUser.php">Verander profiel</a>
                    </li>
                <?php } ?>
                <?php if ($user->getRole() === "Planner" || $user->getRole() === "Systeembeheerder") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="createAuto.php">Auto toevoegen</a>
                    </li>
                <?php } ?>
            </ul>
            <p class="my-2 mr-sm-2"><?php echo $user->email ?></p>
            <a class="nav-item" href="/uitloggen.php">Uitloggen</a>
        </div>
    </nav>
</header>
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
        <h2 style="margin: 1rem">Gebruiker zoeken</h2>
        <form action="editUser.php" method="get" style="margin: 1rem; width: 10vw">
            <div class="form-group">
                <label for="userid">Klant ID</label>
                <input type="number" class="form-control" id="userid" placeholder="Klant id" name="id" required>
                <button style="margin-top: 1rem" class="btn btn-primary">Zoeken</button>
            </div>
        </form>
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