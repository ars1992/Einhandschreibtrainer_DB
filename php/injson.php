
<?php
// Schreibt berbeitete Auswertungsdaten von main.js in die JSON Datei
// Beim Speichern
ini_set("error_reporting", 1);
$list = $_REQUEST["list"];
$user = $_REQUEST["user"];

$filename = "../json/newUser.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);


for ($i = 0; $i < count($json_decoded->users); $i++) {
    if ($json_decoded->users[$i]->username == $user) {
        $json_decoded->users[$i]->auswertung = $list;
        $json_encoded = json_encode($json_decoded);
        file_put_contents($filename, $json_encoded);
        break;
    }
}


?>