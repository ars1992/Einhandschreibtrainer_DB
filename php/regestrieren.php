<?php

$email = htmlentities($_POST["email"]);
$passwort1 = htmlentities($_POST["passwort1"]);
$passwort2 = htmlentities($_POST["passwort2"]);
$hand = $_POST["hand"];


$filename = "../json/newUser.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);
$auswertung = '[
["a", 0, 0], ["b", 0, 0], ["c", 0, 0],
["d", 0, 0], ["e", 0, 0], ["f", 0, 0],
["g", 0, 0], ["h", 0, 0], ["i", 0, 0],
["j", 0, 0], ["k", 0, 0], ["l", 0, 0],
["m", 0, 0], ["n", 0, 0], ["o", 0, 0],
["p", 0, 0], ["q", 0, 0], ["r", 0, 0],
["s", 0, 0], ["t", 0, 0], ["u", 0, 0],
["v", 0, 0], ["w", 0, 0], ["x", 0, 0],
["z", 0, 0], ["y", 0, 0], ["A", 0, 0],
["B", 0, 0], ["C", 0, 0], ["D", 0, 0],
["E", 0, 0], ["F", 0, 0], ["G", 0, 0],
["H", 0, 0], ["I", 0, 0], ["J", 0, 0],
["K", 0, 0], ["L", 0, 0], ["M", 0, 0],
["N", 0, 0], ["O", 0, 0], ["P", 0, 0],
["Q", 0, 0], ["R", 0, 0], ["S", 0, 0],
["T", 0, 0], ["U", 0, 0], ["V", 0, 0],
["W", 0, 0], ["X", 0, 0], ["Z", 0, 0],
["Y", 0, 0], ["ä", 0, 0], ["ü", 0, 0],
["ö", 0, 0], ["ß", 0, 0], ["Ä", 0, 0],
["Ö", 0, 0], ["Ü", 0, 0], [" ", 0, 0],
["0", 0, 0], ["1", 0, 0], ["2", 0, 0],
["3", 0, 0], ["4", 0, 0], ["5", 0, 0],
["6", 0, 0], ["7", 0, 0], ["8", 0, 0],
["9", 0, 0]
]';


function istUserLoginOk($json_decoded, $email)
{
    foreach ($json_decoded->users as $name => $wert) {
        if ($wert->email == $email) {
            echo "Nutzer bereits vergeben <br>";
            return false;
        }
    }
    return true;
};

function neuenUserAnlegen($email, $hand, $filename, $json_decoded, $passwort1, $passwort2, $auswertung)
{
    $anzahlUser = count($json_decoded->users);
    echo $anzahlUser. "<br>";
    if (istUserLoginOk($json_decoded, $email) && hashPasswort($passwort1, $passwort2) != -1) {
        $hashPaswd = hashPasswort($passwort1, $passwort2);
        $json_decoded->users[$anzahlUser] = array("email"=> $email, "passwort"=> $hashPaswd, "hand"=> $hand, "auswertung"=> $auswertung);
        $json_encoded = json_encode($json_decoded);
        file_put_contents($filename, $json_encoded);
        echo "Ihr Benutzer wurde angelegt";
    }
}

function hashPasswort($passwort1, $passwort2){
    if($passwort1 == $passwort2){
        return password_hash($passwort1, PASSWORD_DEFAULT);
    } else {
        echo "Paswörter stimmen nicht überein. <br>";
        return -1;
    }
}

neuenUserAnlegen($email, $hand, $filename, $json_decoded, $passwort1, $passwort2, $auswertung);