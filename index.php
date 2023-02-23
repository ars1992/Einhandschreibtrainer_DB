<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <title>Login Schreibtrainer</title>
    <style>
        body {
            background-color: rgb(41, 41, 41);
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="headline row g-3">
            <hr />
            <div class="col-6">
                <h1 class="headline_main ">Einhandschreibtrainer</h1>
            </div>
            <div class="login col-6 ">
                <form action="php/formT.php" class="login_form row row-cols-lg-auto g-3 align-items-center" method="POST">
                    <div class="col-12">
                        <input type="email" class="login_email form-control" name="email" placeholder="Email" />
                    </div>
                    <div class="col-12">
                        <input type="password" class="login_passwort form-control" name="passwort" placeholder="Passwort" />
                    </div>
                    <div class="col-12">
                        <input type="submit" class="login_submit btn btn-outline-light" name="submit" value="Login" />
                    </div>
                </form>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="bilder col-12 ">
                <img src="img/tasta_rechts.png" alt="Tastatur" title="Tastatur" class="bilder_img img-fluid" />
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="regestrieren col-4">
                <form action="php/regestrieren.php" class="regestrieren_form " method="POST">
                    <h2 class="regestrieren_sub">Regestrieren</h2>
                    <label for="email" class="regestrieren_label form-label">Email</label>
                    <br />
                    <input type="email" class="regestrieren_email form-control" name="email" />
                    <br />
                    <label for="password" class="regestrieren_label form-label">Passwort</label>
                    <br />
                    <input type="password" class="regestrieren_passwort1 form-control" name="passwort1" />
                    <br />
                    <label for="password2" class="regestrieren_label form-label">Passwort wiederholen</label>
                    <br />
                    <input type="password" class="regestrieren_passwort2 form-control" name="passwort2" />
                    <br />
                    <label for="Hand" class="regestrieren_hand form-label">Mit welcher Hand schreiben Sie</label>
                    <br />
                    <input type="radio" name="hand" value="rechts" checked class="regestrieren_handRechts" />
                    <label for="Rechts" class="form-label">Rechts</label>
                    <input type="radio" name="hand" value="links" class="regestrieren_handLinks" />
                    <label for="Links" class="form-label">Links</label>
                    <input type="submit" class="regestrieren_submit btn btn-outline-light" name="submit" value="Regestrieren" />
                </form>
            </div>
            <div class="text col-8">
                <p class="text_paragraph ">
                    Herzlich Willkommen bei meinem Übungsprogramm für die 5 Finger
                    Tastatur!
                </p>
                <p class="text_paragraph ">
                    Mein Programm wurde speziell entwickelt, um Ihnen zu helfen, Ihre
                    Tippfähigkeiten auf der Tastatur zu verbessern. Mit den Funktionen
                    unserer Webanwendung können Sie Ihre Fingerfertigkeit trainieren und
                    Ihre Schreibgeschwindigkeit steigern.
                </p>
                <p class="text_paragraph ">
                    Nach erfolgreicher Registrierung können Sie mit dem Üben beginnen.
                    Sie können einfach einen Übungstext auswählen und die Einstellungen
                    an Ihre Bedürfnisse anpassen. Während Sie üben, werden Ihre
                    Fortschritte gespeichert, so dass Sie Ihren Erfolg verfolgen und
                    Ihre Schwächen gezielt verbessern können.
                </p>
                <p class="text_paragraph">
                    Ich bin stolz darauf, Ihnen ein Übungsprogramm anbieten zu können,
                    das nicht nur effektiv ist, sondern auch Spaß macht. ich hoffe, dass
                    Sie mit meinem Programm Ihre Fähigkeiten auf der 5 Finger Tastatur
                    verbessern und Ihre Schreibgeschwindigkeit steigern können.
                </p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="js/cookie.js"></script>
</body>

</html>