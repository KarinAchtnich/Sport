<?php
/**
 * Created by PhpStorm.
 * User: 1034580
 * Date: 07.12.2018
 * Time: 13:33
 */

session_start();
// This is okay

$name = $Pswd= "";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" >
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
<div id="Login">
    <h2>Login</h2>
    <form action="Login.php" METHOD="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="User">@</span>
            </div>
            <input type="text" class="form-control" name = "Username" placeholder="Username" aria-label="Username">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class=input-group-text>Password</span>
            </div>
            <input type="text" class="form-control"  name = "Password" placeholder="Password" aria-label="Password">
        </div>
        <button type="submit" class="btn btn-outline-primary">Login</button>
    <a href = register.php>Registrieren</a>
    </form>
    <?php

        $dbdir = '.';
        $db = new SQLite3("$dbdir/sq3.db");

        $res = $db->query("SELECT * FROM registier WHERE online = '1'");
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $vorher= $dsatz ['username'];
            $d = $dsatz ['gruppe'];
            //echo "Gruppe: $d<br>" . $vorher."\n <br>";
            $ach= $dsatz ['passwd'];
        }
        $db->close();

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

  if(empty($_POST["Username"])){$nameer = "Name required"; }
else{$name= test_input($_POST["Username"]); }

    if(empty($_POST["Password"])){$Pswder = "Passwd required"; }
    else{$Pswd= test_input($_POST["Password"]); }

   // function logen(){


        $dbdir = '.';
        $db = new SQLite3("$dbdir/sq3.db");

        $res = $db->query("SELECT * FROM registier WHERE username= '$name'");
        while ($dsatz = $res->fetchArray(1)) {
            $l = $dsatz ['username'];
            $d = $dsatz ['gruppe'];
            echo "Gruppe: $d<br>" . $l.": ";
            $c = $dsatz ['passwd'];
            if ($b = $c) {
                echo "Login Success <br>";
                $db->query("UPDATE registier SET online = '0' WHERE username = '$vorher'");
                $db->query("UPDATE registier SET online = '1' WHERE username = '$l'");
                echo "Loged in";
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

