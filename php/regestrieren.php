
<?php
//ini_set("error_reporting", 1);
$username = htmlentities($_POST["username"]);
$passwort1 = htmlentities($_POST["passwort1"]);
$passwort2 = htmlentities($_POST["passwort2"]);
$hand = $_POST["hand"];


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


istUserLoginOk($username, $header, $footer, $mainUV);

// prüft ob eingaben des usernames des Users möglich sind für eine Regestration
function istUserLoginOk($username, $header, $footer, $mainUV)
{
    echo $header;

    $verbindungZurDB = new mysqli("", "root", "", "test");
    //$sqlAbfrage = "SELECT username FROM user WHERE username = $username;";
    $sqlAbfrage = "SELECT username FROM user;";

    $anfrage = $verbindungZurDB->query($sqlAbfrage);
    
    if($anfrage->fetch_assoc() == 0){
        echo "keine ergebnisse";
    };

    while($datensatz = $anfrage->fetch_assoc()){
        echo $datensatz["username"]. "<br>";
        echo $username;
        if($datensatz["username"] == $username){
            echo $mainUV;
            break;
        } else {
            echo "nutzer anlegen";
        }
    };

    echo $footer;
};









// hasht das Passwort wen beide eingaben identich sind
function hashPasswort($passwort1, $passwort2)
{
    if ($passwort1 == $passwort2) {
        return password_hash($passwort1, PASSWORD_DEFAULT);
    } else {
        return -1;
    }
}


?>