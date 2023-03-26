<?php 
$list = $_REQUEST["list"];
$user = $_REQUEST["user"];

if(isset($user)){
    $verbindungZurDB = new mysqli("", "root", "", "usereinhandschreibtrainer");

}

?>