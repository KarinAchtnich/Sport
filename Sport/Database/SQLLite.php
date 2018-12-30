<?php
/**
 * Created by PhpStorm.
 * User: 1034580
 * Date: 14.12.2018
 * Time: 13:13
 */

$dbdir = '.';
$db = new SQLite3("$dbdir/sq3.db");

$db->exec("DROP TABLE personen");
$db->exec("CREATE TABLE  personen (username varchar(45),passwd varchar(45), online char(1));");
//$db->exec("CREATE TABLE video (name varchar(45), video longblob);");

// Login
$db ->query("CREATE TABLE registier (username varchar(45), gruppe varchar(45), passwd varchar(45), online char(1))");

$db->query("INSERT INTO personen  VALUES ('Lehrer', '1','0')");
$db->query("INSERT INTO personen values ('Sudo su', '1', '0')");
$db->query("INSERT INTO personen VALUES ('Gast', '1','1')");

$db->query("UPDATE personen SET online = '0' WHERE username = 'Gast'");
$db->query("UPDATE personen SET online = '1' WHERE username = 'Sudo su'");

$res =$db->query("SELECT * FROM personen WHERE online = '1'");
while ($dsatz =$res->fetchArray(SQLITE3_ASSOC)) {
    echo $dsatz ['username'];
}
// Videos
$db->exec("create table Tvideos (filename longblob, sportart varchar 30, 
abteilung varchar(10), Klasse char(1), Jahr year, Semester char(2),path varchar(45))");


$db->close();

