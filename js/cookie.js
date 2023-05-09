"use strict"

// setzt cookie um user zu identifizieren
// um richtige Auswertungsdaten zuzuordnen
const cookieSetzen = {
    button: document.querySelector(".login_submit"),
    cookieName: function () {
        this.button.addEventListener("click", () => {
            let user = document.querySelector(".login_email").value
            document.cookie = "user=" + user
        })
    }
}

//Überprüft die Passwortlänge bei der
//registration
// const passwortLänge = {
//     divRegestriren: document.querySelector(".regestrieren"),
//     buttonRegestriren: document.querySelector(".regestrieren_submit"),

//     passwordLängeOk: function () {
//         this.buttonRegestriren.addEventListener("click", (ev) => {
//             let div = document.querySelector(".regestrieren")
//             let pElemente = div.childNodes
//             for (let i = 0; i < pElemente.length; i++) {
//                 if (pElemente[i].nodeName === "P") {
//                     div.removeChild(pElemente[i])
//                     i--
//                 }
//             }

//             let passwort = document.querySelector(".regestrieren_passwort1").value
//             if (passwort.length < 8) {
//                 ev.preventDefault()
//                 let neuesP1 = document.createElement("p")
//                 let neuerT1 = document.createTextNode("Passwort zu Kurz.")
//                 neuesP1.appendChild(neuerT1)
//                 neuesP1.classList.add("text-danger")
//                 let neuesP2 = document.createElement("p")
//                 let neuerT2 = document.createTextNode("Mindestens acht Zeichen.")
//                 neuesP2.appendChild(neuerT2)
//                 neuesP2.classList.add("text-danger")
//                 this.divRegestriren.appendChild(neuesP1)
//                 this.divRegestriren.appendChild(neuesP2)
//             }
//         })
//     }
// }

document.addEventListener("DOMContentLoaded", () => {
    cookieSetzen.cookieName()
    passwortLänge.passwordLängeOk()
})