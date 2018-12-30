<?php
/**
 * Created by PhpStorm.
 * User: Karin
 * Date: 29.12.2018
 * Time: 17:46
 */
session_start();
// This is okay

$name = $Pswd = "";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sport Video Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Eigene Stylesheet -->
    <link rel="Stylesheet" href="Stylesheet2.css">
</head>
<body>
<h3>Sport Video Portal</h3>
<nav>
    <ul class="nav">
        <li class="nav-item"><a href="Index.php" class="nav-link active">Algemein</a></li>
        <li class="nav-item"><a href="Hochladen.php" class="nav-link active">Hochladen</a></li>
        <li class="nav-item"><a href="Loeschen.php" class="nav-link active">Löschen</a></li>
        <li class="nav-item"><a href="Suchen.php" class="nav-link active">Suchen</a></li>
        <li class="nav-item"><a href="Login.php" class="nav-link active">Login</a></li>
    </ul>
</nav>
<div id="Reg">
    <h2>Registrieren</h2>
    <form action="register.php" METHOD="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="User">@</span>
            </div>
            <input type="text" class="form-control" name="Username" placeholder="Username" aria-label="Username">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Gruppe</label>
            </div>
            <select class="custom-select" id="Semester" name="Semester">
                <option selected value="null">Choose...</option>
                <option value="Sudo su">SchülerIn</option>
                <option value="Lehrer">Lehrer</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class=input-group-text>Password</span>
            </div>
            <input type="text" class="form-control" name="Password" placeholder="Password" aria-label="Password">
        </div>
        <button type="submit" class="btn btn-outline-primary">Registieren</button>
    </form>
    <?php


    $gruppe = "null";
    if (isset($_POST['Semester'])) {
        $gruppe = $_POST['Semester'];
        //if(!($Semester = "null")){
        //echo "you have selected Gruppe: " . $Semester . "<br>";//}
    }


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["Username"])) {
        $nameer = "Name required";
    } else {
        $name = $_POST["Username"];
    }


    if (empty($_POST["Password"])) {
        $Pswder = "Passwd required";
    } else {
        $Pswd = $_POST["Password"];
    }

    // function logen(){


    $dbdir = '.';
    $db = new SQLite3("$dbdir/sq3.db");
    //  $db->query("drop table registier");
    //$db ->query("CREATE TABLE registier (username varchar(45) primary key, gruppe varchar(45), passwd varchar(45), online char(1))");

    $l = "null";
    $res = $db->query("SELECT * FROM registier WHERE username='$name'");
    while ($dsatz = $res->fetchArray(1)) {
        $l = $dsatz ['username'];
        $g = $dsatz['gruppe'];
        $c = $dsatz ['passwd'];
    }
    if (!($name == "")) {
        if (!($name == $l)) {
            $db->query("Insert into registier(username,gruppe,passwd,online) values ('$name','$gruppe', '$Pswd','0')");
            $res = $db->query("SELECT * FROM registier WHERE username='$name'");
            while ($dsatz = $res->fetchArray(1)) {
                $l = $dsatz ['username'];
                $g = $dsatz['gruppe'];
                echo "Gruppe: " . $g . "<br>";
                echo "username: " . $l . "<br> <br>";
                $c = $dsatz ['passwd'];
            }
        }

        else{
            echo "der Name ". $name . " gibt es schon";
        }
    }


    $db->close();
    //}


    ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>

