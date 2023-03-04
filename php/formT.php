<?php
ini_set("error_reporting", 1);
$username = htmlentities($_POST["username"]);
$passwort = htmlentities($_POST["passwort"]);

# file holen und bearbeiten
$filename = "../json/newUser.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);

$body = 
' <body>
<header class="header">
  <div class="dis-flex border">
    <div class="username dis-flex">
      <div>
        <h2 class="username_sub">Sie sind eingeloggt :</h2>
        <span class="username_span">alessandro@salomon.gmx.de</span><br>
        <a class="username_logout" href="../index.php">logout</a>
      </div>
    </div>
    <div class="headline dis-flex">
      <h1 class="headline_main">Einhandschreibtrainer</h1>
    </div>
    <div class="headermenue dis-flex r">
    <a href="../Hilfe/hilfe.html" target="new" class="headermenue_link">Hilfe</a>
    </div>
  </div>
</header>

<main class="content">
  <div class="card">
    <div class="menue">
      <div class="menue_grid">
        <p class="menue_anschlaegeMin">0</p>
        <button class="menue_startButton">Stop</button>
        <p class="menue_paragraphTextAuswahl">Textauswahl</p>
        <select class="menue_textAuswahl">
          <option value="Text1" class="menue_textOption">1</option>
          <option value="Text2" class="menue_textOption">2</option>
          <option value="Text3" class="menue_textOption">3</option>
          <option value="Text4" class="menue_textOption">4</option>
          <option value="Text5" class="menue_textOption">5</option>
          <option value="Text6" class="menue_textOption">6</option>
          <option value="Text7" class="menue_textOption">7</option>

        </select>
        <p class="menue_paragrapZeitAuswahl">Zeitauswahl</p>
        <select class="menue_zeitAuswahl">
          <option value="120" class="menue_textOption">2min</option>
          <option value="300" class="menue_textOption">5min</option>
          <option value="600" class="menue_textOption">10min</option>
          <option value="900" class="menue_textOption">15min</option>
          <option value="1200" class="menue_textOption">20min</option>
          <option value="60" class="menue_textOption">60s</option>
        </select>
        <p class="menue_timer">0</p>
      </div>
    </div>
    <div class="text">
      <div class="text_grid">
        <input type="output" readonly class="text_lauf-f text_lauf"></input>
        <p class="text_lauf-m text_lauf"></p>
        <input type="output" readonly class="text_lauf-a text_lauf"></input>
      </div>
    </div>
    <div class="tasta">
      <div class="tasta_grid">
        <div class="tasta_taste-1 taste">1</div>
        <div class="tasta_taste-blau taste">blau</div>
        <div class="tasta_taste-2 taste">2</div>
        <div class="tasta_taste-3 taste">3</div>
        <div class="tasta_taste-4 taste">4</div>
        <div class="tasta_taste-5 taste">5</div>
        <div class="tasta_taste-gelb taste">gelb</div>
        <div class="tasta_taste-rot taste">rot</div>
        <div class="tasta_taste-9 taste">9</div>
        <div class="tasta_taste-10 taste">10</div>
      </div>
    </div>
    <div class="start">
      <p class="start_paragraph">Leertaste zum Start</p>
    </div>
    <div class="auswertung auswertung_none">
      <div class="auswertung_grid">
        <h2 class="auswertung_sub">Auswertung</h2>
        <p class="auswertung_datum">Datum</p>
        <p class="auswertung_fehlergesamt">
          Fehlergesamt: <span class="span_fehlergesamt"> 0 </span>
        </p>
        <p class="auswertung_fehlerProzent">
          In Prozent: <span class="span_fehlerProzent">0</span>
        </p>
        <p class="auswertung_anschlaege">
          Anschläge: <span class="span_anschlaege">0</span>
        </p>
        <table class="auswertung_table">
          <tr class="auswertung_tr">
            <th class="auswertung_th">Buchstabe</th>
            <th class="auswertung_th">Fehler</th>
            <th class="auswertung_th">Von</th>
          </tr>
          <tr class="auswertung_tr">
            <th class="auswertung_th platz1_buchstabe"></th>
            <th class="auswertung_th"><span class="platz1_fehler"></span></th>
            <th class="auswertung_th platz1_von">5</th>
          </tr>
          <tr class="auswertung_tr">
            <th class="auswertung_th platz2_buchstabe"></th>
            <th class="auswertung_th platz2_fehler">
              <span class="platz2_fehler"></span>
            </th>
            <th class="auswertung_th platz2_von">5</th>
          </tr>
          <tr class="auswertung_tr">
            <th class="auswertung_th platz3_buchstabe"></th>
            <th class="auswertung_th platz3_fehler"></th>
            <th class="auswertung_th platz3_von">1</th>
          </tr>
          <tr class="auswertung_tr">
            <th class="auswertung_th platz4_buchstabe"></th>
            <th class="auswertung_th platz4_fehler"></th>
            <th class="auswertung_th platz4_von">1</th>
          </tr>
          <tr class="auswertung_tr">
            <th class="auswertung_th platz5_buchstabe"></th>
            <th class="auswertung_th platz5_fehler"></th>
            <th class="auswertung_th platz5_von">1</th>
          </tr>
        </table>
        <button class="auswertung_resetButton">Reset</button>
        <button class="auswertung_speichern">Speichern</button>
        <div class="auswertung_gesamt">
          <h2 class="auswertung_sub">Gesamtauswertung</h2>
          <div class="auswertung_gesamtergebnis">
            <p class="auswertung_beschreibung">Buchstabe</p>
            <p class="auswertung_beschreibung">Fehler</p>
            <p class="auswertung_beschreibung">Von</p>
            <div class="auswertung_divBody">
              <template class="auswertung_template">
                <div class="template_div">
                  <p class="template_data_B"></p>
                  <p class="template_data_B"></p>
                  <p class="template_data_B"></p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<footer class="footer">
  <div class="footer_div border dis-flex">
    <p class="myname">ARS92 &#169;</p>
  </div>
</footer>
<script src="../js/main.js"></script>
</body>
</html>';

$fehler = '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleReg.css" />
    <title>Fehler</title>
  </head>
  <body>
    <header class="header">
      <div class="border dis-flex">
        <div class="headline dis-flex">
          <h1 class="headline_main">Einhandschreibtrainer</h1>
        </div>
      </div>
    </header>

    <main class="content">
      <div class="anzeige">
        <h2 class="anzeige_sub">Passwort oder Email nicht bekannt.</h2>
        <a href="../index.php" class="anzeige_link">Zurück</a>
      </div>
    </main>

    <footer class="footer">
      <div class="footer_div border dis-flex">
        <p class="myname">ARS92 &#169;</p>
      </div>
    </footer>
  </body>
</html>';


if ( ! isset($_COOKIE["user"])) {
  echo $fehler;
  return;
} else {
  istUserLoginOk($json_decoded, $username, $passwort, $body, $fehler);
}

function istUserLoginOk($json_decoded, $username, $passwort, $body, $fehler)
{
  foreach ($json_decoded->users as $name => $wert) {
    if ($wert->username == $username  && password_verify($passwort, $wert->passwort)) {
      if ($wert->hand == "links") {
        echo '<!DOCTYPE html>
                <html lang="de">
                  <head>
                    <meta charset="UTF-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <link rel="stylesheet" href="../css/styleL.css">
                    <title>Tastatur Links</title>
                  </head>';
      } else {
        echo '<!DOCTYPE html>
                <html lang="de">
                  <head>
                    <meta charset="UTF-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <link rel="stylesheet" href="../css/styleR.css">
                    <title>Tastatur Rechts</title>
                  </head>';
      }
      echo $body;
      return;
    }
  }
  echo $fehler;
};

?>
