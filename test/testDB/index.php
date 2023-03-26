<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Test DB</title>
</head>

<body>
    <form action="index.php" method="get">
        <input type="text" name="name">
        <input type="submit">
    </form>

    <?php
    // $usernameInput = $_GET["name"];
    // $con = new mysqli("", "root", "", "usereinhandschreibtrainer"); // host, username, kennwort, db
    // if ($con->connect_error) {
    //     exit("Fehler bei der Verbindung");
    // }

    // $sql = "SELECT * FROM user";
    // if ($res = $con->query($sql)) {
    //     if ($res->num_rows == 0) {
    //         echo "Keine Ergebnisse";
    //     }
    //     // echo ($res->fetch_assoc())[$usernameInput];
    //     while ($dsatz = $res->fetch_assoc()) {
    //         // echo $dsatz["passwort"] . ", " . $dsatz["username"] . "<br>";
    //         $username = $dsatz["username"];

    //         if ($username == $usernameInput) {
    //             // hier müssen die daten aus json in db 
    //             $sql2 = "SELECT * FROM auswertung";

    //             // $sql_auswertung = "INSERT INTO `auswertung` (`username`, `Datum`, `FehlerProzent`, `FehlerGesamt`, `a`, `b`, `c`, `d`, `e`, `f`) VALUES ($username, '2023-03-21', '45', '34', '1', '1', '5', '6', '8', '9')";
    //             // $ps = $con->prepare("INSERT INTO `auswertung` (`username`, `Datum`, `FehlerProzent`, `FehlerGesamt`, `a`, `b`, `c`, `d`, `e`, `f`) VALUES ($username, '2023-03-21', '45', '34', '1', '1', '5', '6', '8', '9')");

    //             $datensatz = ($con->query($sql2)->fetch_assoc())["a"];

    //             echo $datensatz;




    //             $res->close();
    //             return;
    //         }
    //     }

    //     $con->close();
    // } else {
    //     exit("Fehler bei der Abfrage");
    // }

    ?>

    <!-- ablage
    INSERT INTO `auswertung` (`username`, `Datum`, `FehlerProzent`, `FehlerGesamt`, `a`, `b`, `c`, `d`, `e`, `f`) VALUES ('a@b', '2023-03-21', '45', '34', '1', '1', '5', '6', '8', '9'); -->

    <?php 
        $nameuser_s = htmlentities($_GET["name"]);
        if(isset($nameuser_s)){
            $verbindungZurDB = new mysqli("", "root", "", "usereinhandschreibtrainer");
            // $daten = $verbindungZurDB->prepare("INSERT INTO auswertung (username, Datum, FehlerProzent, FehlerGesamt, a, b, c, d, e, f) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $daten = $verbindungZurDB->prepare("INSERT INTO auswertung  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            

            // $daten->bind_param("ssids", $_POST[$nameuser_s], $_POST["2023-03-03"], $_POST["100"], $_POST["45"], $_POST["10"], $_POST["45"], $_POST["30"], $_POST["30"], $_POST["30"], $_POST["30"]);
            $daten->bind_param("ssiiiiiiii", $nameuser_s, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10);
            
            
            $v2 = "2023-09-09";
            $v3 = 3;
            $v4 = 4;
            $v5 = 5;
            $v6 = 6;
            $v7 = 7;
            $v8 = 8;
            $v9 = 9;
            $v10 = 10;
            $daten->execute();

            if($daten->affected_rows > 0) echo "ok <br>";
            else echo "fehler <br>";

            $daten->close();
            $verbindungZurDB->close();
        }
    ?>


    <div class="row">
        <div class="regestrieren col-4">
            <form action="index.php" class="regestrieren_form needs-validation" method="POST">
                <h2 class="regestrieren_sub">Regestrieren</h2>
                <label for="username" class="regestrieren_label form-label">Username</label>
                <br />
                <input type="text" class="regestrieren_email form-control rounded-0" name="username" />
                <br />
                <label for="password" class="regestrieren_label form-label">Passwort</label>
                <br />
                <input type="password" class="regestrieren_passwort1 form-control rounded-0" name="passwort1" />
                <br />
                <label for="password2" class="regestrieren_label form-label">Passwort wiederholen</label>
                <br />
                <input type="password" class="regestrieren_passwort2 form-control rounded-0" name="passwort2" />
                <br />
                <label for="Hand" class="regestrieren_hand form-label">Mit welcher Hand schreiben Sie</label>
                <br />
                <input type="radio" name="hand" value="rechts" checked class="regestrieren_handRechts ms-1" />
                <label for="Rechts" class="form-label">Rechts</label>
                <input type="radio" name="hand" value="links" class="regestrieren_handLinks ms-5" />
                <label for="Links" class="form-label">Links</label>
                <input type="submit" class="regestrieren_submit btn btn-outline-dark rounded-0 ms-5" name="submit" value="Regestrieren" />
            </form>
        </div>
    </div>

    <?php
    $usernameInput = $_POST["username"];
    $password1 = $_POST["passwort1"];
    $password2 = $_POST["passwort2"];

    $connection = @new mysqli("", "root", "", "usereinhandschreibtrainer");
    if ($connection->connect_error) {
        exit("Fehler bei der Verbindung");
    }

    $sqlAbfrage = "SELECT * FROM user";
    if ($res = $connection->query($sqlAbfrage)) {
        if ($res->num_rows == 0) {
            echo "Keine Ergebnisse";
        }

        while ($daten = $res->fetch_assoc()) {
            if ($daten["username"] == $usernameInput) {
                echo "nutzer Vergeben";
            } elseif ($password1 == $password2) {
                $hashpassword = password_hash($password1, PASSWORD_DEFAULT);
                // echo $hashpassword;


            }
        }
        $res->close();
    }

    $connection->close()
    ?>

</body>

</html>