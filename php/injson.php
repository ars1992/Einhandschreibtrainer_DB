
<?php
// header("Content-Type: text/xml");
$list = $_REQUEST["list"];
$user = $_REQUEST["user"];

$filename = "../json/newUser.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);


for ($i = 0; $i < count($json_decoded->users); $i++) {
    if ($json_decoded->users[$i]->email == $user) {
        $json_decoded->users[$i]->auswertung = $list;
        $json_encoded = json_encode($json_decoded);
        file_put_contents($filename, $json_encoded);
        break;
    }
}


?>