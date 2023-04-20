<?php

use function PHPSTORM_META\type;

$list = $_REQUEST["list"];
$username = $_REQUEST["user"];
$anschläge = $_REQUEST["anschläge"];
$fehlerInProzent = $_REQUEST["fehlerProzent"];
$fehlerGesamt = $_REQUEST["fehlerGesamt"];
$datum = date("Y-m-d");




//hier in db

$dbVerbindung = new mysqli("", "root", "", "test");
if($dbVerbindung->connect_error){
    echo "db fehler";
    exit;
}


$sqlUserID = $dbVerbindung->prepare("SELECT user_id FROM user WHERE username = ?");

//user id
$sqlUserID->bind_param("s", $username);
$sqlUserID->execute();
$userID = $sqlUserID->bind_result($userID);
//echo "userID: ". ($userID + 1). $userID . "<br>";
$sqlUserID->close();

//durchlauf speichern
if($sqlDurchlaufSchreiben = $dbVerbindung->prepare("INSERT INTO durchlauf (user_ID) VALUES(?);")){
    if($sqlDurchlaufSchreiben->bind_param("i", $userID)){
        $sqlDurchlaufSchreiben->execute();
    }
}else echo "f2";
$sqlDurchlaufSchreiben->close();

//durchlauf id holen
if($sqlDurchlaufID = $dbVerbindung->prepare("SELECT durchlauf_id FROM durchlauf WHERE durchlauf_id AND user_id = ? ORDER BY durchlauf_id DESC")){
    if($sqlDurchlaufID->bind_param("i", $userID)){
        $sqlDurchlaufID->execute();
        $durchlaufNr = $sqlDurchlaufID->bind_result($durchlaufNr);

        $maxDurchlaufNr = 0;
        while($sqlDurchlaufID->fetch()){
            if($durchlaufNr > $maxDurchlaufNr){
                $maxDurchlaufNr = $durchlaufNr;
                break;
            }
        }
        echo $maxDurchlaufNr;
    }
}

//auswertung speichern
// if($sqlAuswertungSchreiben = $dbVerbindung->prepare(
//     "INSERT INTO auswertung (durchlauf_ID, datum, anschläge, fehler_Prozent, fehler_Gesamt)
//     VALUES (?, ?, ?, ?, ?);")){
//         if($sqlAuswertungSchreiben->bind_param("isiii", $))

// }




// zum testen was kommt
$filename = "../json/test.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);
$json_decoded = array(
    "test" => $list, 
    "user" => $username, 
    "date" => $datum, 
    "anschläge" => $anschläge, 
    "gf" => $fehlerGesamt, 
    "fp" => $fehlerInProzent,
    "id" => $userID,
);

$json_encoded = json_encode($json_decoded);
file_put_contents($filename, $json_encoded);


$test = "[[\"a\",0,0],[\"b\",0,0],[\"c\",0,0],[\"d\",0,0],[\"e\",0,0],[\"f\",0,0],[\"g\",0,0],[\"h\",0,0],[\"i\",0,0],[\"j\",0,0],[\"k\",0,0],[\"l\",0,0],[\"m\",0,0],[\"n\",0,0],[\"o\",0,0],[\"p\",0,0],[\"q\",0,0],[\"r\",0,0],[\"s\",0,0],[\"t\",0,0],[\"u\",0,0],[\"v\",0,0],[\"w\",0,0],[\"x\",0,0],[\"z\",0,0],[\"y\",0,0],[\"A\",0,0],[\"B\",0,0],[\"C\",0,0],[\"D\",0,0],[\"E\",0,0],[\"F\",0,0],[\"G\",0,0],[\"H\",0,0],[\"I\",0,0],[\"J\",0,0],[\"K\",0,0],[\"L\",0,0],[\"M\",0,0],[\"N\",0,0],[\"O\",0,0],[\"P\",0,0],[\"Q\",0,0],[\"R\",0,0],[\"S\",0,0],[\"T\",0,0],[\"U\",0,0],[\"V\",0,0],[\"W\",0,0],[\"X\",0,0],[\"Z\",0,0],[\"Y\",0,0],[\"\u00e4\",0,0],[\"\u00fc\",0,0],[\"\u00f6\",0,0],[\"\u00df\",0,0],[\"\u00c4\",0,0],[\"\u00d6\",0,0],[\"\u00dc\",0,0],[\" \",0,0],[\"0\",0,0],[\"1\",0,0],[\"2\",0,0],[\"3\",0,0],[\"4\",0,0],[\"5\",0,0],[\"6\",0,0],[\"7\",0,0],[\"8\",0,0],[\"9\",0,0]]";
echo $test;


?>