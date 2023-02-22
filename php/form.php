<?php
$email = htmlentities($_POST["email"]);
$passwort = htmlentities($_POST["passwort"]);

# file holen und bearbeiten
$filename = "../json/newUser.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);


if (!$email or !$passwort) {
    echo "<h1> 404 </h1>";
} else {
    istUserLoginOk($json_decoded, $email, $passwort);
}



// ziel seite hier einfügen ??
// login umgehen ist im momment möglich
// http://localhost/files/testLogin/Tastatur/rechts/tastaRechts.html
function istUserLoginOk($json_decoded, $email, $passwort)
{
    foreach ($json_decoded->users as $name => $wert) {
        if ($wert->email == $email  && password_verify($passwort, $wert->passwort)) {
            echo "Sie sind Eingelogt <br>";
            echo $email. "<br>";
            if ($wert->hand == "rechts") {
                echo "<a href='../includes/tastaRechts.html'>Zur Tastatur</a>";
                
            } else {
                echo "<a href='../includes/tastaLinks.html'>Zur Tastatur</a>";
            }
            return true;
        }
    }
    echo "Passwort oder Email nicht bekannt";
    return true;
};

?>

