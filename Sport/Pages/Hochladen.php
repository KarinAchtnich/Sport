<?php
/**
 * Created by PhpStorm.
 * User: 1034580
 * Date: 07.12.2018
 * Time: 13:32
 */
session_start();

function testlog()
{
    $dbdir = '.';
    $db = new SQLite3("$dbdir/sq3.db");

    $res = $db->query("SELECT * FROM registier WHERE online = '1'");
    while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
        $vorher = $dsatz ['gruppe'];
    }
    $db->close();
    $allowed = true;
    echo "Currently Gruppe in: " . $vorher;
    if ($vorher == "Gast") {
        $allowed = false;
        echo "your not allowed to upload something";
    }
    return $allowed;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getotherInfo() // erhalten von Inputs
{
    $Name = "null";
    if (empty($_POST["Name"])) {
        $Name = "null";
        //echo "<br>your Filename: ".$Name;
    } else {
        $Name = test_input($_POST["Name"]);
        echo "<br>Name: " . $Name;
    }

    $Sport = "null";
    if (isset($_POST['Sport'])) {
        $Sport = $_POST['Sport'];
        echo "<br>you have selected Sport: " . $Sport . "<br>";
    }


    $Abteil = "null";
    if (isset($_POST['Abteilung'])) {
        $Abteil = $_POST['Abteilung'];
        echo "you have selected Abteilung: " . $Abteil . "<br>";

    }

    $Klasse = "null";
    if (isset($_POST['Klasse'])) {
        $Klasse = $_POST['Klasse'];
        echo "you have selected Klasse: " . $Klasse . "<br>";
    }

    $Jahr = "null";
    if (isset($_POST['Jahr'])) {
        $Jahr = $_POST['Jahr'];
        echo "you have selected Jahr: " . $Jahr . "<br>";
    }
    $Semester = "null";
    if (isset($_POST['Semester'])) {
        $Semester = $_POST['Semester'];
        echo "you have selected Semester: " . $Semester . "<br>";
    }
    intoDb($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester);
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
<div id="hoch">
    <h2>Hochladen</h2>
    <form action="Hochladen.php" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="Name" name="Name" placeholder="filename" aria-label="filename">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Sportart</label>
            </div>
            <select class="custom-select" id="Sport" name="Sport">
                <option selected value="null">Choose...</option>
                <option value="Vergessene">Vergessene</option>
                <option value="Aktrobatik">Akrobatik</option>
                <option value="Aikido">Aikido</option>
                <option value="Badminton">Badminton</option>
                <option value="Baseball">Baseball</option>
                <option value="Beachvolleyball">Beachvolleyball</option>
                <option value="Diskwurf">Diskwurf</option>
                <option value="Eishockey">Eishockey</option>
                <option value="Federball">Federball</option>
                <option value="Fussball">Fussball</option>
                <option value="Geräteturnen">Geräteturnen</option>
                <option value="Gymnastik">Gymnastik</option>
                <option value="Handball">Handball</option>
                <option value="Hindernislauf">Hindernislauf</option>
                <option value="Hochsprung">Hochsprung</option>
                <option value="Klettern">Klettern</option>
                <option value="Kugelstoss">Kugelstoss</option>
                <option value="Leichtatlethik">Leichtatlethik</option>
                <option value="Orientierungslauf">Orientierungslauf</option>
                <option value="Pilates">Pilates</option>
                <option value="Quidditch">Quidditch</option>
                <option value="Reiten">Reiten</option>
                <option value="Run and Bike">Run and Bike</option>
                <option value="Schwimmen">Schwimmen</option>
                <option value="Smolball">Smolball</option>
                <option value="Staffellauf">Staffellauf</option>
                <option value="Tanzed">Tanzen</option>
                <option value="Unihockey">Unihockey</option>
                <option value="Völkerball">Völkerball</option>
                <option value="Volleyball">Volleyball</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="Abteilung">Abteilung</label>
            </div>
            <select class="custom-select" id="abteilung" name="Abteilung">
                <option selected value="null">Choose...</option>
                <option value="FMS">FMS</option>
                <option value="GMS">GMS</option>
                <option value="IMS">IMS</option>
                <option value="HMS">HMS</option>
                <option value="Andere">Andere</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Klasse</label>
            </div>
            <select class="custom-select" id="Klasse" name="Klasse">
                <option selected value="null">Choose...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Jahr</label>
            </div>
            <select class="custom-select" id="Jahr" name="Jahr">
                <option selected value="null">Choose...</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Semester</label>
            </div>
            <select class="custom-select" id="Semester" name="Semester">
                <option selected value="null">Choose...</option>
                <option value="HS">HS</option>
                <option value="FS">FS</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <!--<  <div class="input-group-prepend">
                  <span class="input-group-text">Upload</span>
              </div>
         <!--<div class="custom-file">
                  <input type="file" class="custom-file-input" id="File" name ="File">
                  <label class="custom-file-label" for="File">Choose file</label>
              </div> -->
            <form action="Hochladen.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file"><br><br>
                <input type="submit" value="Submit" name="submit">
            </form>
        </div>
        <button type="submit" class="btn btn-outline-primary" id="trigger" name="trigger" value="null">Upload</button>
    </form>
    <?php
    testlog();
    getotherInfo();
    //testen
    function getFile()
    {
        // if (isset($_POST['submit'])) {
        if (isset($_FILES["file"]["name"])) {

            $name = $_FILES["file"]["name"];
            $tmp_name = $_FILES['file']['tmp_name'];
            $error = $_FILES['file']['error'];

            if (!empty($name)) {
                $location = 'downloads/';

                if (move_uploaded_file($tmp_name, $location . $name)) {
                    echo 'Uploaded';
                }

            } else {
                echo 'please choose a file';
            }
        } else {
            echo "<br>Das File wurde nicht gefunden";
        }
        //}
    }

    function intoDb($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester)
    {
        $dbdir = '.';
        $db = new SQLite3("$dbdir/sq3.db");
        // $db->exec("drop table tvideo");
        //  $db->exec("create table Tvideo (id integer primary key ,filename varchar(45) , sportart varchar(30),
        //  abteilung varchar(10), Klasse char(1), Jahr year, Semester char(2),path varchar(45))");
        //   echo "<br> Tabelle erstellt";

        $Path = "Videos/" . $Name . ".mp4";


        if (!($Name == "null")) {
            $db->exec("Insert into Tvideo values(null,'$Name','$Sport','$Abteil','$Klasse','$Jahr','$Semester','$Path')");
            echo " Datei drüben";
            echo "<br> Success";
        } else {
            echo "<br>Der Name ist leer";
        }
        $db->close();
    }


    if (isset($_POST['trigger'])) { // dont react???
        $Ab = "graaaaaa";
        echo $Ab;

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