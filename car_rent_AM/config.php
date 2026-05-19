<?php
$db_server = "localhost";
$db_kasutaja = "root";
$db_salasona = "";
$db_andmebaas = "autolaenutus";

$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);

if (!$yhendus) {
    die("Ei saa ühendust andmebaasiga: " . mysqli_connect_error());
}
?>