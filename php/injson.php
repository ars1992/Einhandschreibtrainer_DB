<?php



$list = $_REQUEST["list"];
$username = $_REQUEST["user"];
$anschläge = $_REQUEST["anschläge"];
$fehlerInProzent = $_REQUEST["fehlerProzent"];
$fehlerGesamt = $_REQUEST["fehlerGesamt"];
$datum = date("Y-m-d");

// abfrage ob daten vorhanden
if( ! isset($anschläge)){
    exit;
}

// nützliche Daten ?
$maxRealAPM = 500;
if($anschläge <= 0 || $anschläge >= $maxRealAPM){
    exit;
}


//hier in db

$dbVerbindung = new mysqli("", "root", "", "test");
if($dbVerbindung->connect_error){
    echo "<script>console.log('DB ERROR')</script>";
    exit;
}


$sqlUserID = $dbVerbindung->prepare("SELECT user_id FROM user WHERE username = ?");

//user id
$sqlUserID->bind_param("s", $username);
$sqlUserID->execute();
$userID = $sqlUserID->bind_result($userID);
$sqlUserID->fetch();


$sqlUserID->close();

//durchlauf speichern
if($sqlDurchlaufSchreiben = $dbVerbindung->prepare("INSERT INTO durchlauf (user_ID) VALUES(?);")){
    if($sqlDurchlaufSchreiben->bind_param("i", $userID)){
        $sqlDurchlaufSchreiben->execute();
    }
}else echo "<script>console.log('DB ERROR')</script>";
$sqlDurchlaufSchreiben->close();


//durchlauf id holen
//SELECT MAX(durchlauf_id) FROM `durchlauf` 
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
    }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlDurchlaufID->close();


//auswertung speichern
if($sqlAuswertungSchreiben = $dbVerbindung->prepare(
    "INSERT INTO auswertung (durchlauf_ID, datum, anschlaege, fehler_Prozent, fehler_Gesamt) VALUES (?, ?, ?, ?, ?);")){
        if($sqlAuswertungSchreiben->bind_param("isiii", $maxDurchlaufNr, $datum, $anschläge, $fehlerInProzent, $fehlerGesamt)){
            $sqlAuswertungSchreiben->execute();
        }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlAuswertungSchreiben->close();



$listArray = json_decode($list);

//Fehler speichern
if($sqlFehlerZeichenSchreiben = $dbVerbindung->prepare("INSERT INTO zeichenfehler (durchlauf_id, a, b, c) VALUES (?, ?, ?, ?);")){
    if($sqlFehlerZeichenSchreiben->bind_param("iiii", $maxDurchlaufNr, $listArray[0][1], $listArray[1][1], $listArray[2][1])){
        $sqlFehlerZeichenSchreiben->execute();
    }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlFehlerZeichenSchreiben->close();

if($sqlGesamtZeichenSchreiben = $dbVerbindung->prepare("INSERT INTO zeichengesamt (durchlauf_id, a, b, c) VALUES (?, ?, ?, ?);")){
    if($sqlGesamtZeichenSchreiben->bind_param("iiii", $maxDurchlaufNr, $listArray[0][2], $listArray[1][2], $listArray[2][2])){
        $sqlGesamtZeichenSchreiben->execute();
    }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlGesamtZeichenSchreiben->close();
$dbVerbindung->close();




?>