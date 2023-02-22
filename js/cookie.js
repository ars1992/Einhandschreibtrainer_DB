"use strict"

const cookieSetzen = {
    button: document.querySelector(".login_submit"),
    cookieName: function () {
        this.button.addEventListener("click", () => {
            let user = document.querySelector(".login_email").value
            console.log(user, "hallo")

            console.log("user=" + user)
            document.cookie = "user=" + user
        })
    }
}

document.addEventListener("DOMContentLoaded", () => {
    cookieSetzen.cookieName()
})