<?php
session_start();
require_once "models/User.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Garage bedrijf</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row align-items-center justify-content-center" style="margin-top: 10%">
        <div class="col-md-7">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form action="registerUser.php" method="post">
                        <div class="form-group">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" class="form-control" id="username" placeholder="Gebruikersnaam" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" maxlength="6" minlength="6" id="postcode" placeholder="Postcode" name="postcode" required>
                        </div>
                        <div class="form-group">
                            <label for="adres">Adres</label>
                            <input type="text" class="form-control" id="adres" placeholder="Adres" name="adres" required>
                        </div>
                        <div class="form-group">
                            <label for="plaats">Plaats</label>
                            <input type="text" class="form-control" id="plaats" placeholder="Plaats" name="plaats" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="index.php">Login</a>
                    </form>
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