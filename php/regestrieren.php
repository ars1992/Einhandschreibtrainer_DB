
<?php
ini_set("error_reporting", 1);
$username = htmlentities($_POST["username"]);
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

$header = '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleReg.css">
    <title>Regestriert</title>
  </head>
  <body>
    <header class="header">
     <div class="dis-flex border">
      <div class="headline dis-flex">
        <h1 class="headline_main">Einhandschreibtrainer</h1>
      </div>
     </div> 
    </header>';

$mainFP = '
<main class="content">
<div class="anzeige">
  <h2 class="anzeige_sub">Passwörter stimmen nicht überein.</h2>
  <a href="../index.php" class="anzeige_link">Zurück</a>
</div>
</main>';

$mainUV = '
<main class="content">
<div class="anzeige">
  <h2 class="anzeige_sub">Nutzer bereits vergeben.</h2>
  <a href="../index.php" class="anzeige_link">Zurück</a>
</div>
</main>';

$mainOK = '
<main class="content">
<div class="anzeige">
  <h2 class="anzeige_sub">Ihr Benutzer wurde angelegt.</h2>
  <a href="../index.php" class="anzeige_link">Zurück</a>
</div>
</main>';

$footer = '
  <footer class="footer">
   <div class="footer_div border dis-flex">
    <p class="myname">ARS92 &#169;</p>
   </div>
  </footer>
 </body>
</html>';


// prüft ob eingaben des usernames des Users möglich sind für eine Regestration
function istUserLoginOk($json_decoded, $username, $passwort1)
{
    foreach ($json_decoded->users as $name => $wert) {
        if ($wert->username == $username) {
            return false;
        }
        // mit requerd in html sollte diese bedingung nicht möglich sein.
        if ($username == "" || count_chars($passwort1) == 0) {
            return false;
        }
    }
    return true;
};

// zeigt an mit ver. seiten ob regesration erfolgreich war oder nicht
function neuenUserAnlegen(
    $username,
    $hand,
    $filename,
    $json_decoded,
    $passwort1,
    $passwort2,
    $auswertung,
    $header,
    $footer,
    $mainFP,
    $mainUV,
    $mainOK
) {
    $anzahlUser = count($json_decoded->users);
    echo $header;
    if (istUserLoginOk($json_decoded, $username, $passwort1) && hashPasswort($passwort1, $passwort2) != -1) {
        $hashPaswd = hashPasswort($passwort1, $passwort2);
        $json_decoded->users[$anzahlUser] = array("username" => $username, "passwort" => $hashPaswd, "hand" => $hand, "auswertung" => $auswertung);
        $json_encoded = json_encode($json_decoded);
        file_put_contents($filename, $json_encoded);
        echo $mainOK;
    } else if (!istUserLoginOk($json_decoded, $username, $passwort1)) {
        echo $mainUV;
    } else {
        echo $mainFP;
    }
    echo $footer;
}

// hasht das Passwort wen beide eingaben identich sind
function hashPasswort($passwort1, $passwort2)
{
    if ($passwort1 == $passwort2) {
        return password_hash($passwort1, PASSWORD_DEFAULT);
    } else {
        return -1;
    }
}

neuenUserAnlegen(
    $username, 
    $hand, 
    $filename, 
    $json_decoded, 
    $passwort1, 
    $passwort2, 
    $auswertung, 
    $header, 
    $footer, 
    $mainFP, 
    $mainUV, 
    $mainOK
);

?>