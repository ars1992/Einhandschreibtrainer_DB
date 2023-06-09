"use strict"
// verwaltet generirte Daten während der Übung
const fehlerVerarbeitung = {

    _list: [
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
        ["9", 0, 0],
        ["\'", 0, 0], ["-", 0, 0], ["]", 0, 0],
        ["^", 0, 0], ["[", 0, 0], ["?", 0, 0],
        ["=", 0, 0], ["#", 0, 0], ["!", 0, 0],
        ["§", 0, 0], ["@", 0, 0], ["_", 0, 0],
        [">", 0, 0], [")", 0, 0], ["|", 0, 0],
        ["+", 0, 0], ["/", 0, 0], ["$", 0, 0],
        ["*", 0, 0], ["%", 0, 0], ["&", 0, 0],
        [")", 0, 0], ["<", 0, 0], ["\\", 0, 0],
        ["`", 0, 0], ["\"", 0, 0], ["€", 0, 0],
        [".", 0, 0], [",", 0, 0], [":", 0, 0],
        [";", 0, 0], ["}", 0, 0], ["{", 0, 0],
    ],



    istRichtigeReihenfolge: function (list) {
        if (!list) {
            return false
        }
        for (let i = 1; i < list.length; i++) {
            if (list[i - 1][1] < list[i][1]) {
                return false
            }
        }
        return true
    },

    getfehlerAuswertung: function (list) {
        if (!list) {
            return false
        }
        while (!this.istRichtigeReihenfolge(list)) {
            for (let i = 1; i < list.length; i++) {
                if (list[i - 1][1] < list[i][1]) {
                    const temp = list[i - 1]
                    list[i - 1] = list[i]
                    list[i] = temp
                }
            }
        }
        return list
    },

    getKopieListeUnsortiert: function() {
        let neueListe = []
        for (const element of this._list){
            neueListe.push(element)
        }
        return neueListe
    },

    setFehlerZähler: function (eingabe, anzeige) {
        if (eingabe !== anzeige) {
            for (let i = 0; i < this._list.length; i++) {
                if (this._list[i][0] === anzeige) {
                    this._list[i][1]++
                }
            }
        }
    },

    setZeichenZähler: function (anzeige) {
        for (let i = 0; i < this._list.length; i++) {
            if (anzeige === this._list[i][0]) {
                this._list[i][2]++
            }
        }
    },

    getFehlerGesamt: function () {
        let fehlerGesamt = 0
        for (const element of this._list) {
            fehlerGesamt += element[1]
        }
        return fehlerGesamt
    },

    getFehlerInProzent: function () {
        if (this.zeichenGesamt() <= 0) {
            return 0
        }
        return parseInt(this.getFehlerGesamt() / this.zeichenGesamt() * 100)
    },

    zeichenGesamt: function () {
        let zeichenGesamt = 0
        for (const element of this._list) {
            zeichenGesamt += element[2]
        }
        return zeichenGesamt
    },

    // für spätere funktion zum zurücksetzen der gesamtauswertung
    setFehlerZurückSetzen: function (list) {
        for (let i = 0; i < list.length; i++) {
            this._list[i][1] = 0
            this._list[i][2] = 0
        }
    },
}

// Sendet die Bearbeitete Daten an PHP injson.php
const DatenAnJsonSenden = {

    _auswertungsDaten: null,

    send: function () {
        let xhr = new XMLHttpRequest()
        if (this._auswertungsDaten !== null) {
            // für server pfad ändern

            // neu für DB
           // xhr.open("PUT", "_injson.php?list=" + JSON.stringify(fehlerVerarbeitung._list.slice(0, 70)) + "&user=" + cookieVerwalten.getCookie("user"), false)

            // zum aufaddiren der ergebnisse in json alt
            xhr.open("PUT", "_injson.php?list=" + this._auswertungsDaten + "&user=" + cookieVerwalten.getCookie("user"), false)
            xhr.send()
        } else {
            console.log("keine Daten vorhanden")
        }
    },

    setAuswertungsDaten: function (list) {
        this._auswertungsDaten = JSON.stringify(list)
        this.send()
    },
}

const DatenAnDBSenden = {
    _auswertungsDaten: null,

    send: function () {
        let xhr = new XMLHttpRequest()
        if (this._auswertungsDaten !== null) {
            // für server pfad ändern

            // neu für DB
            xhr.open("PUT", 
            "injson.php?list=" + JSON.stringify(fehlerVerarbeitung._list.slice(0, 26)) + 
            "&user=" + cookieVerwalten.getCookie("user") +
            "&fehlerGesamt=" + fehlerVerarbeitung.getFehlerGesamt() +
            "&fehlerProzent=" + fehlerVerarbeitung.getFehlerInProzent() +
            "&anschläge=" + Menue.getAnschlagProMin(), false)
            xhr.send()
        } else {
            console.log("keine Daten vorhanden")
        }
    },

    setAuswertungsDaten: function (list) {
        this._auswertungsDaten = JSON.stringify(list)
        this.send()
    },
}

// stellt Auswertungsdaten aus der newUser.json datei bereit
const AuswertungHolen = {

    _data: null,

    holen: function () {
        let xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                AuswertungHolen._data = xhr.responseText
            }
        }
        xhr.open("POST", "../json/newUser.json", false)
        xhr.setRequestHeader("Content-type", "application/json")
        xhr.setRequestHeader("Cache-Control", "no-cache, no-store, max-age=0")
        xhr.send()
    },

    getData: function () {
        this.holen()
        return JSON.parse(this._data)
    }
}

// bearbeitet auswertungsdaten aus newUser.json um neu generirte Daten
// aus für die Gesamtauswertung zu aktuallisiren
// addiert fehler auf
const AuswertungBearbeiten = {

    _data: AuswertungHolen.getData(),
    _userDaten: null,

    auswertungAusDatenHolen: function () {
        for (const element of this._data["users"]) {
            if (element["username"] === cookieVerwalten.getCookie("user")) {
                this._userDaten = JSON.parse(element["auswertung"])
            }
        }
    },

    datenAktualisiren: function () {
        if (this._userDaten) {
            // zum test für das speichern eines durchlaufes in Db
            //this._userDaten = fehlerVerarbeitung._list.slice(0, 70)
            // #################################################
            for (const zeichen of fehlerVerarbeitung._list.slice(0, 70)) {
                for (const zeichenUserDaten of this._userDaten) {
                    if (zeichen[0] === zeichenUserDaten[0]) {
                        zeichenUserDaten[1] += zeichen[1]
                        zeichenUserDaten[2] += zeichen[2]
                        break
                    }
                }
            }
        }
    },


    getUserDaten: function () {
        this.auswertungAusDatenHolen()
        if (this._userDaten) {
            return fehlerVerarbeitung.getfehlerAuswertung(this._userDaten)
        }
    },
}

// stellt das gesetzte cookie beim login bereit
// löscht es beim abmelden
// pfad je nach nach systempfad ändern
const cookieVerwalten = {

    getCookie: function (cookieName) {
        let cookieDaten = document.cookie.split(";")
        for (let i = 0; i < cookieDaten.length; i++) {
            let arraySplit = cookieDaten[i].split("=")
            for (let j = 0; j < arraySplit.length; j++) {
                if (arraySplit[j].includes(cookieName)) {
                    return arraySplit[j + 1]
                }
            }
        }
    },
    // für server pfad ändern
    cookieLöschen: function (cookieName) {
        document.cookie = cookieName + "=" + "; path=/files/Schreibtrainer_v1.0" + "; expires=Sun, 05 Jan 1992 23:00:00 UTC"
    }
}

// Zum speichern der erzeugten userdaten
// beim click auf Speichern in der Auswertung
const DatenSpeichern = {
    speicherButton: document.querySelector(".auswertung_speichern"),

    speichern: function () {
        this.speicherButton.addEventListener("click", () => {
            cookieVerwalten.getCookie("user")
            AuswertungBearbeiten.auswertungAusDatenHolen()
            AuswertungBearbeiten.datenAktualisiren()

            //für db
            DatenAnDBSenden.setAuswertungsDaten(fehlerVerarbeitung._list)
            
            // für json
            // DatenAnJsonSenden.setAuswertungsDaten(AuswertungBearbeiten._userDaten)
            Auswertung.allesZurückSetzen()
        })
    }
}

// zeig alle daten des übungsdurchlaufes in der Auswertung an
const Auswertung = {

    auswertungDatum: document.querySelector(".auswertung_datum"),
    auswertungAnzeigen: document.querySelector(".auswertung"),
    resetButton: document.querySelector(".auswertung_resetButton"),
    ausgabeFehlerGesamt: document.querySelector(".span_fehlergesamt"),
    ausgabeFehlerProzent: document.querySelector(".span_fehlerProzent"),
    ausgabeAnschläge: document.querySelector(".span_anschlaege"),
    ausgabePlatz_1_Buchsabe: document.querySelector(".platz1_buchstabe"),
    ausgabePlatz_2_Buchsabe: document.querySelector(".platz2_buchstabe"),
    ausgabePlatz_3_Buchsabe: document.querySelector(".platz3_buchstabe"),
    ausgabePlatz_4_Buchsabe: document.querySelector(".platz4_buchstabe"),
    ausgabePlatz_5_Buchsabe: document.querySelector(".platz5_buchstabe"),

    ausgabePlatz_1_Fehler: document.querySelector(".platz1_fehler"),
    ausgabePlatz_2_Fehler: document.querySelector(".platz2_fehler"),
    ausgabePlatz_3_Fehler: document.querySelector(".platz3_fehler"),
    ausgabePlatz_4_Fehler: document.querySelector(".platz4_fehler"),
    ausgabePlatz_5_Fehler: document.querySelector(".platz5_fehler"),

    ausgabePlatz_1_Von: document.querySelector(".platz1_von"),
    ausgabePlatz_2_Von: document.querySelector(".platz2_von"),
    ausgabePlatz_3_Von: document.querySelector(".platz3_von"),
    ausgabePlatz_4_Von: document.querySelector(".platz4_von"),
    ausgabePlatz_5_Von: document.querySelector(".platz5_von"),

    inAuswertung: false,



    autoAuswertung: () => {
        let x = fehlerVerarbeitung.getKopieListeUnsortiert()
        console.log(x)
        
        Auswertung.erstellenGesamtAuswertung()

        Auswertung.inAuswertung = true
        let listeTopFünfFehler = fehlerVerarbeitung.getfehlerAuswertung(fehlerVerarbeitung.getKopieListeUnsortiert()).slice(0, 5)
        setTimeout(clearInterval(Menue._time))
        StartAnzeige.ausblenden()
        Auswertung.auswertungAnzeigen.classList.remove("auswertung_none")
        Auswertung.auswertungAnzeigen.classList.add("auswertung_notNone")

        let aktuellesDatum = Date.now()
        const datumAnzeige = { day: "numeric", month: "numeric", year: "2-digit", hour: "numeric", minute: "numeric" }
        Auswertung.auswertungDatum.innerText = Intl.DateTimeFormat("de-DE", datumAnzeige).format(aktuellesDatum)
        Auswertung.ausgabeAnschläge.innerText = parseInt(Menue.getAnschlagProMin())
        Auswertung.ausgabeFehlerGesamt.innerText = fehlerVerarbeitung.getFehlerGesamt()
        Auswertung.ausgabeFehlerProzent.innerText = fehlerVerarbeitung.getFehlerInProzent()

        Auswertung.ausgabePlatz_1_Buchsabe.innerText = listeTopFünfFehler[0][0]
        Auswertung.ausgabePlatz_2_Buchsabe.innerText = listeTopFünfFehler[1][0]
        Auswertung.ausgabePlatz_3_Buchsabe.innerText = listeTopFünfFehler[2][0]
        Auswertung.ausgabePlatz_4_Buchsabe.innerText = listeTopFünfFehler[3][0]
        Auswertung.ausgabePlatz_5_Buchsabe.innerText = listeTopFünfFehler[4][0]

        Auswertung.ausgabePlatz_1_Fehler.innerText = listeTopFünfFehler[0][1]
        Auswertung.ausgabePlatz_2_Fehler.innerText = listeTopFünfFehler[1][1]
        Auswertung.ausgabePlatz_3_Fehler.innerText = listeTopFünfFehler[2][1]
        Auswertung.ausgabePlatz_4_Fehler.innerText = listeTopFünfFehler[3][1]
        Auswertung.ausgabePlatz_5_Fehler.innerText = listeTopFünfFehler[4][1]

        Auswertung.ausgabePlatz_1_Von.innerText = listeTopFünfFehler[0][2]
        Auswertung.ausgabePlatz_2_Von.innerText = listeTopFünfFehler[1][2]
        Auswertung.ausgabePlatz_3_Von.innerText = listeTopFünfFehler[2][2]
        Auswertung.ausgabePlatz_4_Von.innerText = listeTopFünfFehler[3][2]
        Auswertung.ausgabePlatz_5_Von.innerText = listeTopFünfFehler[4][2]
    },


    auswertungReset: () => {
        Auswertung.resetButton.addEventListener("click", Auswertung.allesZurückSetzen)
    },

    allesZurückSetzen: () => {
        // Auswertung.auswertungAnzeigen.classList.remove("auswertung_notNone")
        // Auswertung.auswertungAnzeigen.classList.add("auswertung_none")

        // StartAnzeige._startAusgabe.startDiv.classList.remove("auswertung_none")
        // StartAnzeige.flackernAnzeige()
        // Tastatur.setTextCounter(0)
        // Menue.setAnzeigeZeitAnschlagAufNull()

        // Tastatur.clearTastatur()
        // TextLauf.laufenderText(Tastatur.textCounter)

        // fehlerVerarbeitung.setFehlerZurückSetzen(fehlerVerarbeitung._list)

        // ProgrammStart.gestartet = false
        // Auswertung.inAuswertung = false
        location.reload()
    },

    // generirt html code aus tamplate und zeigt daten der auswertungsdaten aus newUser.json an
    erstellenGesamtAuswertung: () => {
        let ausgabeTemplate = document.querySelector(".auswertung_template")
        let td = ausgabeTemplate.content.querySelectorAll("p")
        if (AuswertungBearbeiten.getUserDaten()) {

            AuswertungBearbeiten.getUserDaten().forEach(function (dataRow) {
                td[0].textContent = dataRow[0]
                td[1].textContent = dataRow[1]
                td[2].textContent = dataRow[2]

                let tb = document.querySelector(".auswertung_divBody")
                let clone = document.importNode(ausgabeTemplate.content, true)
                tb.appendChild(clone)
            })
        }
    },
}

// steuert die anzeige das man mit der Leertaste starten kann
const StartAnzeige = {
    _startAusgabe: {
        startDiv: document.querySelector(".start"),
        startPara: document.querySelector(".start_paragraph")
    },
    startInterval: null,

    flackernAnzeige: function () {
        this.startInterval = setInterval(() => {
            this._startAusgabe.startPara.classList.toggle("start_flackern")
            Tastatur.taste1.classList.toggle("shift")
        }, 1000)
    },

    ausblenden: function () {
        Tastatur.taste1.classList.remove("shift")
        setTimeout(clearInterval(this.startInterval))
        this._startAusgabe.startDiv.classList.add("auswertung_none")
    },
}

// stellt die texte aus texte.json bereit
const JsonTextlader = {

    jsonDateiName: null,
    data: null,

    _getJsonDatei: () => {
        let xhr = null
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest()
        }

        if (xhr === null) {
            console.log("Fehler")
        }

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                JsonTextlader.data = xhr.responseText
            }
        }

        xhr.open("GET", JsonTextlader.jsonDateiName, false)
        xhr.setRequestHeader("Cache-Control", "no-cache, no-store, max-age=0")
        xhr.send()
    },



    gewähltenTextAusJsonFileFinden: (jsonFile, auswahl) => {
        JsonTextlader.jsonDateiName = jsonFile
        JsonTextlader._getJsonDatei()
        const texte = JSON.parse(JsonTextlader.data, { encoding: "utf-8" })
        for (const text in texte) {
            if (text === auswahl) {
                return texte[text]
            }
        }
    }
}

// zeigt eingeloggten user im header an
// verwaltet den loggout
const Header = {
    usernameSpan: document.querySelector(".username_span"),
    userLogoutLink: document.querySelector(".username_logout"),

    setUsername: function () {
        this.usernameSpan.innerText = cookieVerwalten.getCookie("user")
    },

    logoutUser: function () {
        this.userLogoutLink.addEventListener("click", (ev) => {
            ev.preventDefault()
            cookieVerwalten.cookieLöschen("user")
            location.replace("../index.php")
        })
    }
}

// alle funktionen die im menü bereich 
// timer, textauswahl, apm , zeitauswahl
const Menue = {

    menueTextAuswahl: document.querySelector(".menue_textAuswahl"),
    menueZeitAuswahl: document.querySelector(".menue_zeitAuswahl"),
    menueStoppButton: document.querySelector(".menue_startButton"),
    menueAnschlagAusgabe: document.querySelector(".menue_anschlaegeMin"),
    menueZeitAusgabe: document.querySelector(".menue_timer"),

    _userTime: 120,
    _time: null,
    _aktTime: 0,
    _anschlaegeProMin: 0,

    ausgewählterText: "V1.0 Schreibtrainer",

    _timerStop: function () {
        setInterval(() => {
            if (this._aktTime >= this._userTime) {
                setTimeout(() => { clearInterval(this._time), 50 })
                Auswertung.autoAuswertung()
                this._aktTime = 0
            }
        })
    },

    _timerStart: function () {
        let startTime = Date.now()
        this._time = setInterval(() => {
            this._aktTime = parseInt((Date.now() - startTime) / 1_000)
            this.menueZeitAusgabe.innerText = this._aktTime
        }, 100)
    },

    timerStopButton: function () {
        this.menueStoppButton.addEventListener("click", () => {
            Auswertung.autoAuswertung()
        })
    },

    ersteWahlTime: true,
    set_UserTime: function () {
        this.menueZeitAuswahl.addEventListener("click", () => {
            if (!this.ersteWahlTime) {
                this._userTime = parseInt(this.menueZeitAuswahl.value)
            } else {
                this.ersteWahlTime = false
            }
        })
    },

    setText: function () {
        let ersteWahlText = true
        this.menueTextAuswahl.addEventListener("click", () => {
            if (ersteWahlText) {
                this.ausgewählterText = JsonTextlader.gewähltenTextAusJsonFileFinden("../json/texte.json", this.menueTextAuswahl.value)
            }
            TextLauf.laufenderText(Tastatur.textCounter)
        })
    },

    anschlagMessung: function () {
        setInterval(() => {
            if (Tastatur.textCounter / Menue._aktTime === Infinity) {
                Menue.menueAnschlagAusgabe.innerText = 0
            } else if (Menue._aktTime < this._userTime && Menue._aktTime !== 0) {
                Menue._anschlaegeProMin = (Tastatur.textCounter - 1) / Menue._aktTime * 60
                Menue.menueAnschlagAusgabe.innerText = parseInt(Menue._anschlaegeProMin)
            }
        }, 100)
    },

    getAusgewählterText: function () {
        return this.ausgewählterText
    },

    getAnschlagProMin: function () {
        return this._anschlaegeProMin
    },

    setAnzeigeZeitAnschlagAufNull: function () {
        this.menueAnschlagAusgabe.innerText = 0
        this.menueZeitAusgabe.innerText = 0
        this._aktTime = 0
        this._anschlaegeProMin = 0
    }
}

// generirt die anzeige des zu tippenden textes
const TextLauf = {

    textLaufF: document.querySelector(".text_lauf-f"),
    textLaufM: document.querySelector(".text_lauf-m"),
    textLaufA: document.querySelector(".text_lauf-a"),

    textLängeFrontFeld: 13,
    laufenderText: function (counter) {

        if (counter < this.textLängeFrontFeld) {
            this.textLaufF.placeholder = Menue.getAusgewählterText().slice(0, counter)
        } else {
            this.textLaufF.placeholder = Menue.getAusgewählterText().slice(counter - this.textLängeFrontFeld, counter)
        }

        this.textLaufM.innerHTML = "<u>" + Menue.getAusgewählterText()[counter] + "</u>"
        this.textLaufA.placeholder = Menue.getAusgewählterText().slice(counter + 1, counter + 20)
    }
}

// enthält alle Tastenkompinationen zur anzeige auf der Vtastatur 
// methoden zum mitzählen der erfolgten nutzereingaben während der übung
// methode übung beenden wenn text zu ende
const Tastatur = {

    taste1: document.querySelector(".tasta_taste-1"),
    taste2: document.querySelector(".tasta_taste-2"),
    taste3: document.querySelector(".tasta_taste-3"),
    taste4: document.querySelector(".tasta_taste-4"),
    taste5: document.querySelector(".tasta_taste-5"),
    tasteGelb: document.querySelector(".tasta_taste-gelb"),
    tasteRot: document.querySelector(".tasta_taste-rot"),
    textCounter: 0,

    einzelneTastenBuchstaben: {

        schiftInterval: null,

        tasteLeer: () => {
            Tastatur.taste1.classList.add("green")
        },

        tasteK_a: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_b: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_c: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_d: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_e: () => {
            Tastatur.taste3.classList.add("green")
        },

        tasteK_f: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
        },

        tasteK_g: () => {
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_h: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_i: () => {
            Tastatur.taste4.classList.add("green")
        },

        tasteK_j: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_k: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_l: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
        },

        tasteK_m: () => {
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_n: () => {
            Tastatur.taste5.classList.add("green")
        },

        tasteK_o: () => {
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_p: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_q: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_r: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste3.classList.add("green")
        },

        tasteK_s: () => {
            Tastatur.taste2.classList.add("green")
        },

        tasteK_t: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_u: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_v: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_w: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_x: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_y: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_z: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
        },

        // Umlaute

        tasteK_ä: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_ö: () => {
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        tasteK_ü: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        tasteK_ß: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },

        shiftAnzeige: () => {
            Tastatur.tasteRot.classList.add("shift")
            Tastatur.tasteGelb.classList.add("shift")
            Tastatur.einzelneTastenBuchstaben.schiftInterval = setInterval(() => {

                Tastatur.tasteRot.classList.toggle("shift")
                Tastatur.tasteGelb.classList.toggle("shift")
            }, 500)
        }
    },

    einzelneTastenZahlen: {
        zahlInterval: null,

        taste_0: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        taste_1: () => {
            Tastatur.taste2.classList.add("green")
        },

        taste_2: () => {
            Tastatur.taste3.classList.add("green")
        },

        taste_3: () => {
            Tastatur.taste4.classList.add("green")
        },

        taste_4: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
        },

        taste_5: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste3.classList.add("green")
        },

        taste_6: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        taste_7: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
        },

        taste_8: () => {
            Tastatur.taste3.classList.add("green")
            Tastatur.taste4.classList.add("green")
        },

        taste_9: () => {
            Tastatur.taste4.classList.add("green")
            Tastatur.taste5.classList.add("green")
        },
    },

    einzelneTastenSonderzeichen: {

        intervalSonderzeichen: null,

        taste_punkt: () => {
            Tastatur.taste3.classList.add("green")
            Tastatur.tasteRot.classList.add("green")
        },

        taste_komma: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.tasteGelb.classList.add("green")
        },

        taste_semikolon: () => {
            Tastatur.taste1.classList.add("green")
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.tasteGelb.classList.add("green")
            Tastatur.tasteRot.classList.add("green")
        },

        taste_doppelpunkt: () => {
            Tastatur.taste2.classList.add("green")
            Tastatur.taste3.classList.add("green")
            Tastatur.tasteGelb.classList.add("green")
            Tastatur.tasteRot.classList.add("green")
        },

        sonderzeichenAnzeige: (farbe) => {
            Tastatur[`taste${farbe}`].classList.add("shift")
            Tastatur.einzelneTastenSonderzeichen.intervalSonderzeichen = setInterval(() => {
                Tastatur[`taste${farbe}`].classList.toggle("shift")
            }, 500)
        }
    },

    tastaturAnzeige: (aktuelleTaste) => {
        const kleinBuchstaben = [
            [" ", Tastatur.einzelneTastenBuchstaben.tasteLeer],
            ["a", Tastatur.einzelneTastenBuchstaben.tasteK_a],
            ["b", Tastatur.einzelneTastenBuchstaben.tasteK_b],
            ["c", Tastatur.einzelneTastenBuchstaben.tasteK_c],
            ["d", Tastatur.einzelneTastenBuchstaben.tasteK_d],
            ["e", Tastatur.einzelneTastenBuchstaben.tasteK_e],
            ["f", Tastatur.einzelneTastenBuchstaben.tasteK_f],
            ["g", Tastatur.einzelneTastenBuchstaben.tasteK_g],
            ["h", Tastatur.einzelneTastenBuchstaben.tasteK_h],
            ["i", Tastatur.einzelneTastenBuchstaben.tasteK_i],
            ["j", Tastatur.einzelneTastenBuchstaben.tasteK_j],
            ["k", Tastatur.einzelneTastenBuchstaben.tasteK_k],
            ["l", Tastatur.einzelneTastenBuchstaben.tasteK_l],
            ["m", Tastatur.einzelneTastenBuchstaben.tasteK_m],
            ["n", Tastatur.einzelneTastenBuchstaben.tasteK_n],
            ["o", Tastatur.einzelneTastenBuchstaben.tasteK_o],
            ["p", Tastatur.einzelneTastenBuchstaben.tasteK_p],
            ["q", Tastatur.einzelneTastenBuchstaben.tasteK_q],
            ["r", Tastatur.einzelneTastenBuchstaben.tasteK_r],
            ["s", Tastatur.einzelneTastenBuchstaben.tasteK_s],
            ["t", Tastatur.einzelneTastenBuchstaben.tasteK_t],
            ["u", Tastatur.einzelneTastenBuchstaben.tasteK_u],
            ["v", Tastatur.einzelneTastenBuchstaben.tasteK_v],
            ["w", Tastatur.einzelneTastenBuchstaben.tasteK_w],
            ["x", Tastatur.einzelneTastenBuchstaben.tasteK_x],
            ["y", Tastatur.einzelneTastenBuchstaben.tasteK_y],
            ["z", Tastatur.einzelneTastenBuchstaben.tasteK_z],
            ["ä", Tastatur.einzelneTastenBuchstaben.tasteK_ä],
            ["ö", Tastatur.einzelneTastenBuchstaben.tasteK_ö],
            ["ü", Tastatur.einzelneTastenBuchstaben.tasteK_ü],
            ["ß", Tastatur.einzelneTastenBuchstaben.tasteK_ß],
        ]

        const zahlen = [
            ["0", Tastatur.einzelneTastenZahlen.taste_0],
            ["1", Tastatur.einzelneTastenZahlen.taste_1],
            ["2", Tastatur.einzelneTastenZahlen.taste_2],
            ["3", Tastatur.einzelneTastenZahlen.taste_3],
            ["4", Tastatur.einzelneTastenZahlen.taste_4],
            ["5", Tastatur.einzelneTastenZahlen.taste_5],
            ["6", Tastatur.einzelneTastenZahlen.taste_6],
            ["7", Tastatur.einzelneTastenZahlen.taste_7],
            ["8", Tastatur.einzelneTastenZahlen.taste_8],
            ["9", Tastatur.einzelneTastenZahlen.taste_9]
        ]

        const sonderzeichen = [
            [
                ["€", Tastatur.einzelneTastenBuchstaben.tasteLeer],
                ["'", Tastatur.einzelneTastenBuchstaben.tasteK_a],
                ["-", Tastatur.einzelneTastenBuchstaben.tasteK_b],
                ["]", Tastatur.einzelneTastenBuchstaben.tasteK_c],
                ["^", Tastatur.einzelneTastenBuchstaben.tasteK_d],
                ["[", Tastatur.einzelneTastenBuchstaben.tasteK_e],
                ["?", Tastatur.einzelneTastenBuchstaben.tasteK_f],
                ["=", Tastatur.einzelneTastenBuchstaben.tasteK_g],
                ["#", Tastatur.einzelneTastenBuchstaben.tasteK_h],
                ["!", Tastatur.einzelneTastenBuchstaben.tasteK_i],
                ["§", Tastatur.einzelneTastenBuchstaben.tasteK_j],
                ["@", Tastatur.einzelneTastenBuchstaben.tasteK_k],
                ["_", Tastatur.einzelneTastenBuchstaben.tasteK_l],
                [">", Tastatur.einzelneTastenBuchstaben.tasteK_m],
                [")", Tastatur.einzelneTastenBuchstaben.tasteK_n],
                ["|", Tastatur.einzelneTastenBuchstaben.tasteK_o],
                ["+", Tastatur.einzelneTastenBuchstaben.tasteK_p],
                ["/", Tastatur.einzelneTastenBuchstaben.tasteK_q],
                ["$", Tastatur.einzelneTastenBuchstaben.tasteK_r],
                ["*", Tastatur.einzelneTastenBuchstaben.tasteK_s],
                ["%", Tastatur.einzelneTastenBuchstaben.tasteK_t],
                ["&", Tastatur.einzelneTastenBuchstaben.tasteK_u],
                ["(", Tastatur.einzelneTastenBuchstaben.tasteK_v],
                ["<", Tastatur.einzelneTastenBuchstaben.tasteK_w],
                ["\\", Tastatur.einzelneTastenBuchstaben.tasteK_x],
                ["`", Tastatur.einzelneTastenBuchstaben.tasteK_y],
                ["\"", Tastatur.einzelneTastenBuchstaben.tasteK_z],
            ],
            [
                ["}", Tastatur.einzelneTastenBuchstaben.tasteK_c],
                ["{", Tastatur.einzelneTastenBuchstaben.tasteK_d]
            ],
            [
                [".", Tastatur.einzelneTastenSonderzeichen.taste_punkt],
                [",", Tastatur.einzelneTastenSonderzeichen.taste_komma],
                [":", Tastatur.einzelneTastenSonderzeichen.taste_doppelpunkt],
                [";", Tastatur.einzelneTastenSonderzeichen.taste_semikolon]
            ]
        ]

        // Buchstaben
        for (const buchstabe of kleinBuchstaben) {
            if (buchstabe[0] === aktuelleTaste) {
                buchstabe[1]()
                return
            } else if (buchstabe[0].toUpperCase() === aktuelleTaste) {
                Tastatur.einzelneTastenBuchstaben.shiftAnzeige()
                buchstabe[1]()
                return
            }
        }

        // Zahlen
        for (const zahl of zahlen) {
            if (zahl[0] === aktuelleTaste) {
                Tastatur.einzelneTastenSonderzeichen.sonderzeichenAnzeige("Rot")
                zahl[1]()
                return
            }
        }

        // Sonderzeichen
        for (let i = 0; i < sonderzeichen.length; i++) {
            for (const zeichen of sonderzeichen[i]) {
                if (zeichen[0] === aktuelleTaste) {
                    if (i === 0) {
                        Tastatur.einzelneTastenSonderzeichen.sonderzeichenAnzeige("Gelb")
                        zeichen[1]()
                        return
                    } else if (i === 1) {
                        Tastatur.einzelneTastenSonderzeichen.sonderzeichenAnzeige("Rot")
                        zeichen[1]()
                        return
                    } else {
                        zeichen[1]()
                        return
                    }
                }

            }
        }
    },

    clearTastatur: () => {
        Tastatur.taste1.classList.remove("green")
        Tastatur.taste2.classList.remove("green")
        Tastatur.taste3.classList.remove("green")
        Tastatur.taste4.classList.remove("green")
        Tastatur.taste5.classList.remove("green")
        Tastatur.tasteGelb.classList.remove("green")
        Tastatur.tasteRot.classList.remove("green")
        Tastatur.tasteGelb.classList.remove("shift")
        Tastatur.tasteRot.classList.remove("shift")
        setTimeout(clearInterval(Tastatur.einzelneTastenBuchstaben.schiftInterval))
        setTimeout(clearInterval(Tastatur.einzelneTastenSonderzeichen.intervalSonderzeichen))
    },

    stopProgrammAbfrage: () => {
        if (Tastatur.textCounter > Menue.ausgewählterText.length) {
            Auswertung.autoAuswertung()
        }
    },

    zählerTextCounter: () => {
        if (Tastatur.textCounter <= Menue.ausgewählterText.length) {
            Tastatur.textCounter++
        }
    },
    // mit location.reload zum zurücksetzen nicht mehr nötig
    setTextCounter: (n) => {
        Tastatur.textCounter = n
    }
}

// steuert alle nötigen funktion für den Programmablauf
// nimmt die tasteneingaben des users engegegen 
// startet alle eventlistener 
const ProgrammStart = {

    gestartet: false,

    immer: () => {
        Header.logoutUser()
        Header.setUsername()
        StartAnzeige.flackernAnzeige()
        TextLauf.laufenderText(Tastatur.textCounter)
        Menue.set_UserTime()
        Menue.timerStopButton()
        Menue.setText()
        Auswertung.auswertungReset()
        DatenSpeichern.speichern()
    },

    ersteInteraktion: () => {
        Menue._timerStart()
        Menue._timerStop()
        StartAnzeige.ausblenden()
    },

    interAktion: (taste) => {
        Tastatur.clearTastatur()
        Tastatur.tastaturAnzeige(Menue.ausgewählterText[Tastatur.textCounter])
        TextLauf.laufenderText(Tastatur.textCounter)
        Menue.anschlagMessung()
        fehlerVerarbeitung.setZeichenZähler(Menue.getAusgewählterText()[Tastatur.textCounter])
        fehlerVerarbeitung.setFehlerZähler(
            String.fromCharCode(taste.keyCode),
            Menue.getAusgewählterText()[Tastatur.textCounter - 1]
        )
        Tastatur.zählerTextCounter()
        Tastatur.stopProgrammAbfrage()
    },

    tastenAbfrage: () => {
        window.addEventListener("keypress", (taste) => {
            if (Auswertung.inAuswertung) {
                return
            }

            if (String.fromCharCode(taste.keyCode) === " " && !ProgrammStart.gestartet) {
                ProgrammStart.ersteInteraktion()
                ProgrammStart.gestartet = true
            }

            if (ProgrammStart.gestartet) {
                ProgrammStart.interAktion(taste)

            }
        })
    },

    START: () => {
        document.addEventListener("DOMContentLoaded", () => {
            ProgrammStart.immer()
            ProgrammStart.tastenAbfrage()
        })
    },
}

ProgrammStart.START()
