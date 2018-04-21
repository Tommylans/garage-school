<?php
session_start();
require_once __DIR__ . "/../managers/UserManager.php";
require_once __DIR__ . "/../managers/AutoManager.php";
if (!UserManager::isLoggedin()) {
    header("Location: /index.php");
    exit();
}
$user = UserManager::getUserById($_SESSION['id']);
if (isset($_GET['id'])) {
    if (!$user->getLevel() >= 5) {
        header("Location: index.php");
        exit();
    } else {
        $auto = AutoManager::getAutoById($_GET['id']);
    }
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
    <title>Auto aanpassen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row align-items-center justify-content-center" style="margin-top: 10%">
        <div class="col-md-7">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">Aanpassen auto</h5>
                    <h6><?php echo $auto->kenteken ?></h6>
                    <form action="updateAuto.php" method="post" style="margin-bottom: 1rem">
                        <div class="form-group">
                            <label for="kenteken">Kenteken</label>
                            <input type="text" class="form-control" id="kenteken" placeholder="Kenteken"
                                   name="kenteken" required value="<?php echo $auto->kenteken ?>">
                        </div>
                        <div class="form-group">
                            <label for="eigenaarid">Klant</label>
                            <select class="form-control" id="eigenaarid" name="eigenaarid">
                                <?php foreach (UserManager::all() as $value) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->email ?></option>
                                <?php } ?>
                            </select>
                            <script>
                                document.getElementById("eigenaarid").value = "<?php echo $auto->klantid ?>";
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control"c id="merk"
                                   placeholder="Merk" name="merk" required value="<?php echo $auto->merk ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" placeholder="Type" name="type" required value="<?php echo $auto->type ?>">
                        </div>
                        <div class="form-group">
                            <label for="kmstand">Km stand</label>
                            <input type="number" class="form-control" id="kmstand" placeholder="Km stand" name="kmstand" required value="<?php echo $auto->kmStand ?>">
                        </div>
                        <input type="hidden" name="autoid" value="<?php echo $auto->id ?>">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php">Terug</a>
                    </form>
                    <a <?php echo "href=\"deleteAuto.php?id=$auto->id\"" ?>>
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