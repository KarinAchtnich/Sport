<?php
/**
 * Created by PhpStorm.
 * User: 1034580
 * Date: 07.12.2018
 * Time: 13:32
 */
session_start();
function testlog(){
    $dbdir = '.';
    $db = new SQLite3("$dbdir/sq3.db");

    $res = $db->query("SELECT * FROM registier WHERE online = '1'");
    while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
        $vorher = $dsatz ['gruppe'];
    }
    $db->close();
    $allowed = true;
    echo "Currently Gruppe in: " . $vorher;
    if ($vorher == "Gast" or $vorher == "Sudo su") {
        $allowed = false;
    }
    return $allowed;
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getid(){
    if (empty($_POST["delete"])) {
        $ID = "null";
        //echo "<br>your Filename: ".$Name;
    } else {
        $ID = test_input($_POST["delete"]);
        //if(!($Name = "null")){
        echo "<br>Input: " . $ID;
        return $ID;//}
    }
}
function outDB($ID, $allowed){
    $dbdir = '.';
    $db = new SQLite3("$dbdir/sq3.db");
    // $db->exec("drop table tvideo");
    //  $db->exec("create table Tvideo (id integer primary key ,filename varchar(45) , sportart varchar(30),
    //  abteilung varchar(10), Klasse char(1), Jahr year, Semester char(2),path varchar(45))");
    //   echo "<br> Tabelle erstellt";

    if (!($ID == "null")) {
        if ($allowed == true) {

            $db->exec("DELETE FROM Tvideo WHERE id = '$ID'");
            //if (is_int($ID)) {
            echo " <br>Datei gelöscht (ohne Input vorne dran == keine Bedeutung)";
            //}
        } else {
            echo "<br>Sie haben die Erlaubnis nicht";
        }
    } else {
        echo "<br>Die ID ist leer";
    }
    $db->close();
}
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
<div id="loeschen">
    <h2>Löschen</h2>
    <div id="erklar">
        Sie können nur einen einzigen Video löschen mit der id des Datensatzes.
        Diese Ermitteln Sie bei Suchen.<br>
    </div>
    <form action="Loeschen.php" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="delete">@</span>
            </div>
            <input type="number" class="form-control" name="delete" placeholder="id" aria-label="delete">
        </div>
        <button type="button" class="btn btn-outline-primary" name="trigger" value="null">Löschen</button>
    </form>
    <?php
    $allowed = testlog(); // Tested wer eingelogt ist
    $ID = getid(); // get the input
    outDB($ID, $allowed); // ausloggen




    if (isset($_POST['trigger'])) { // test, aber funktioniert nicht
        echo "<br>hahah";
    }
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