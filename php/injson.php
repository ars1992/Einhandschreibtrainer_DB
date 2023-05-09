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
$maxRealAPM = 5000;
if($anschläge <= 0 || $anschläge >= $maxRealAPM){
    exit;
}


//ab  hier in db
$dbVerbindung = new mysqli("", "root", "", "test");
if($dbVerbindung->connect_error){
    echo "<script>console.log('DB ERROR')</script>";
    exit;
}


//user id
if($sqlUserID = $dbVerbindung->prepare("SELECT user_id FROM user WHERE username = ?")){
    if($sqlUserID->bind_param("s", $username)){
        $sqlUserID->execute();
        $userID = $sqlUserID->bind_result($userID);
        $sqlUserID->fetch();
    }
}else echo "<script>console.log('DB ERROR')</script>";
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
print_r( $listArray);
//Fehler speichern
if($sqlFehlerZeichenSchreiben = $dbVerbindung->prepare(
    "INSERT INTO zeichenfehler (durchlauf_id, a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")){
    if($sqlFehlerZeichenSchreiben->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiii", $maxDurchlaufNr, 
    $listArray[0][1], 
    $listArray[1][1], 
    $listArray[2][1],
    $listArray[3][1],
    $listArray[4][1],
    $listArray[5][1],
    $listArray[6][1],
    $listArray[7][1],
    $listArray[8][1],
    $listArray[9][1],
    $listArray[10][1],
    $listArray[11][1],
    $listArray[12][1],
    $listArray[13][1],
    $listArray[14][1],
    $listArray[15][1],
    $listArray[16][1],
    $listArray[17][1],
    $listArray[18][1],
    $listArray[19][1],
    $listArray[20][1],
    $listArray[21][1],
    $listArray[22][1],
    $listArray[23][1],
    $listArray[24][1],
    $listArray[25][1]
    )){
        $sqlFehlerZeichenSchreiben->execute();
    }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlFehlerZeichenSchreiben->close();

//gesamt speichern
if($sqlGesamtZeichenSchreiben = $dbVerbindung->prepare(
    "INSERT INTO zeichengesamt (durchlauf_id, a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")){
    if($sqlGesamtZeichenSchreiben->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiii", $maxDurchlaufNr, 
    $listArray[0][2], 
    $listArray[1][2], 
    $listArray[2][2],
    $listArray[3][2],
    $listArray[4][2],
    $listArray[5][2],
    $listArray[6][2],
    $listArray[7][2],
    $listArray[8][2],
    $listArray[9][2],
    $listArray[10][2],
    $listArray[11][2],
    $listArray[12][2],
    $listArray[13][2],
    $listArray[14][2],
    $listArray[15][2],
    $listArray[16][2],
    $listArray[17][2],
    $listArray[18][2],
    $listArray[19][2],
    $listArray[20][2],
    $listArray[21][2],
    $listArray[22][2],
    $listArray[23][2],
    $listArray[24][2],
    $listArray[25][2]
    )){
        $sqlGesamtZeichenSchreiben->execute();
    }
} else echo "<script>console.log('DB ERROR')</script>";
$sqlGesamtZeichenSchreiben->close();
$dbVerbindung->close();

// http://www.terragon.de/kuenstliche-intelligenz/python-tutorials/python-in-php-ausfuehren/

exec("python C:/Users/aless/PycharmProjects/Einhandschreibtrainer_Auswertung/main.py $username");

?>