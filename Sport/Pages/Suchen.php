<?php
/**
 * Created by PhpStorm.
 * User: 1034580
 * Date: 07.12.2018
 * Time: 13:32
 */
//OK
session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getotherInfo()
{
    $Name = "null";
    if (empty($_POST["Name"])) {
        $Name = "null";
        //echo "<br>your Filename: ".$Name;
    } else {
        $Name = test_input($_POST["Name"]);
        //if(!($Name = "null")){
        echo "<br>Name: " . $Name;//}
    }

    $Sport = "null";
    if (isset($_POST['Sport'])) {
        $Sport = $_POST['Sport'];
        //if(!($Sport = "null")){
        echo "<br>you have selected Sport: " . $Sport . "<br>";//}
    }


    $Abteil = "null";
    if (isset($_POST['Abteilung'])) {
        $Abteil = $_POST['Abteilung'];
        //if(!($Abteil = "null")){
         echo "you have selected Abteilung: " . $Abteil . "<br>";//}

    }

    $Klasse = "null";
    if (isset($_POST['Klasse'])) {
        $Klasse = $_POST['Klasse'];
        //if(!($Klasse = "null")){
         echo "you have selected Klasse: " . $Klasse . "<br>";//}
    }

    $Jahr = "null";
    if (isset($_POST['Jahr'])) {
        $Jahr = $_POST['Jahr'];
        //if(!($Jahr = "null")){
         echo "you have selected Jahr: " . $Jahr . "<br>";//}
    }
    $Semester = "null";
    if (isset($_POST['Semester'])) {
        $Semester = $_POST['Semester'];
        //if(!($Semester = "null")){
          echo "you have selected Semester: " . $Semester . "<br>";//}
    }
    SearchDb($Name,$Sport,$Abteil,$Klasse,$Jahr,$Semester);
    //factors($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester);
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
<div id="Suchen">
    <h2>Suchen</h2>
    <form action="Suchen.php" method="post">
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
        <button type="submit" class="btn btn-outline-primary" id="trigger" name="trigger" value="null">Suchen</button>
    </form>

    <?php
    function factors($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester)
    {

        $search = "WHERE ";
        $searchplus = "AND ";

        $searchadd = array(
            0 => "filename = '$Name' ",
            1 => "sportart = '$Sport' ",
            2 => "abteilung = '$Abteil' ",
            3 => "Klasse = '$Klasse' ",
            4 => "Jahr = '$Jahr' ",
            5 => "Semester = '$Semester' ");


        $a = array(
            0 => $Name,
            1 => $Sport,
            2 => $Abteil,
            3 => $Klasse,
            4 => $Jahr,
            5 => $Semester);

        $k = 0; // Count
        $var = "";
        $fullsearch= "";
        $f = array(
                0=>null);
        for ($i = 0; $i < 6; $i++) {
            if ($a[$i] == "null"){
                $k++;
            }
            $d = 6-$k;

            if (!($a[$i] == "null")) {
                // echo "<br>".$a[$i];
                $f= array($i);

                $fullsearch = $searchadd[$i] . $searchplus ;
                $var = $var. $fullsearch;
               // if ($i == $d){ // Last
                //    $fullsearch = $fullsearch.$searchadd[$i];

              //  }
                //echo $var;

            }
        }
        $s = "";
        $b = "";
        //echo $var;
        if(strlen($var) > 1){
            $i = strlen($var);
            $s= substr($var,0, $i-4);
           // echo "<br>".$s;
            $b= "WHERE ". $s;
        }
       //echo "<br>". $b;
       return $b;
        //echo "<br>". $f[0];
    }

    function SearchDb($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester)
    {
        $dbdir = '.';
        $db = new SQLite3("$dbdir/sq3.db");

        ///$db->exec("create table Tvideo (id integer primary key ,filename varchar(45) , sportart varchar(30),
        // abteilung varchar(10), Klasse char(1), Jahr year, Semester char(2),path varchar(45))");
        //   echo "<br> Tabelle erstellt";

        $search= factors($Name, $Sport, $Abteil, $Klasse, $Jahr, $Semester);
        $full = "SELECT * FROM tvideo " . $search;

        $res = $db->query( $full );
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            echo "<br> ID: ". $dsatz ['id'] . "<br>";
            echo "Name: ".$dsatz ['filename'] . "<br>";
            echo "Sportart: ".$dsatz ['sportart'] . "<br>";
            echo "Abteilung: ".$dsatz ['abteilung'] . "<br>";
            echo "Klasse: ".$dsatz ['Klasse'] . "<br>";
            echo "Jahr: ".$dsatz ['Jahr'] . "<br>";
            echo "Semester: ".$dsatz ['Semester'] . "<br><br>";
            //echo $dsatz ['path'] . "<br><br>";
        }
        $db->close();
    }

    if(isset($_POST['trigger'])){
        getotherInfo();
    }
    ?>


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