<?php
session_start();
require_once __DIR__ . "/../controllers/UserManager.php";
require_once __DIR__ . "/../controllers/AutoManager.php";
if (!UserManager::isLoggedin()) {
    header("Location: /index.php");
    exit();
}
$user = UserManager::getUserById($_SESSION['id']);
if (isset($_GET['id'])) {
    if ($user->getRole() !== "Planner" && $user->getRole() !== "Systeembeheerder") {
        header("Location: index.php");
        exit();
    } else {
        $editUser = UserManager::getUserById($_GET['id']);
    }
} else if ($user->getLevel() > 1) {
    $editUser = $user;
} else {
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
    <title>Gebruiker aanpassen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row align-items-center justify-content-center" style="margin-top: 10%">
        <div class="col-md-7">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">Aanpassen</h5>
                    <h6><?php echo $editUser->email ?></h6>
                    <form action="updateUser.php" method="post" style="margin-bottom: 1rem">
                        <div class="form-group">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" class="form-control" id="username" placeholder="Gebruikersnaam"
                                   name="username" required value="<?php echo $editUser->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control" id="rol" name="rol">
                                <?php if ($user->getRole() === "Systeembeheerder") { ?>
                                    <option>Systeembeheerder</option>
                                <?php } ?>
                                <option>Planner</option>
                                <option>Directie</option>
                                <option>Monteur</option>
                                <option>Klant</option>
                            </select>
                            <script>
                                document.getElementById("rol").value = "<?php echo $editUser->getRole() ?>";
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" maxlength="6" minlength="6" id="postcode"
                                   placeholder="Postcode" name="postcode" required
                                   value="<?php echo $editUser->postcode ?>">
                        </div>
                        <div class="form-group">
                            <label for="adres">Adres</label>
                            <input type="text" class="form-control" id="adres" placeholder="Adres" name="adres" required
                                   value="<?php echo $editUser->adres ?>">
                        </div>
                        <div class="form-group">
                            <label for="plaats">Plaats</label>
                            <input type="text" class="form-control" id="plaats" placeholder="Plaats" name="plaats"
                                   required value="<?php echo $editUser->plaats ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                   required value="<?php echo $editUser->email ?>">
                        </div>
                        <input type="hidden" name="userid" value="<?php echo $editUser->id ?>">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php">Terug</a>
                    </form>
                    <a <?php if (count($editUser->getAutos()) == 0) {
                        echo "href=\"deleteUser.php?id=$editUser->id\"";
                    } else {
                        echo "onclick=\"alert('Deze gebruiker bezit nog een auto!');\"";
                    } ?>>
                        <button class="btn btn-danger">Verwijder</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
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