<?php
    $db_server = 'localhost';
    $db_andmebaas = 'autolaenutus';
    $db_kasutaja = 'ameronen';
    $db_salasona = 'ameronen';


    $yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);


    if (!$yhendus) {
        die('Ei saa ühendust andmebaasiga');
    }
?>


