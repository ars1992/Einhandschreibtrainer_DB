<?php 
$list = $_REQUEST["list"];
$user = $_REQUEST["user"];



if(isset($list)){$x = 0;}

if(isset($user)){
    $verbindungZurDB = new mysqli("", "root", "", "usereinhandschreibtrainer");
    $daten = $verbindungZurDB->prepare("INSERT INTO auswertung  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $daten->bind_param("ssiiiiiiii", $nameuser_s, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10);

}

function stringZuArray($list, $username){
    $v2 = "2023-09-09";
    $v3 = 3;
    $v4 = 4;
    $v5 = 5;
    $v6 = 6;
    $v7 = 7;
    $v8 = 8;
    $v9 = 9;
    $v10 = 10;
    $array = array($username );
}


?>