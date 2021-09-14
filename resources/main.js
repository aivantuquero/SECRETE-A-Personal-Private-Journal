//generate options for the select tag 'day' in signup.php
const d = document.getElementById("dd");
for (var i = 1; i <= 31; i++) {
    d.add(new Option(i, i));
}

//generate options for the select tag 'year' in signup.php
const y = document.getElementById("yyyy");
for (var i = 1900; i < 2024; i++) {
    y.add(new Option(i, i));
}

function validateRegister() {

    var firstpass = document.getElementById("password").value;
    var secondpass = document.getElementById("password2").value;
    var email = document.getElementById("email").value;

    var result = true;

    if (firstpass != secondpass) {
        document.getElementById("err").innerHTML = "Password does not match";
        result = false;
    }

    if (!validateEmail(email)) {
        document.getElementById("err").innerHTML = "Invalid email";
        result = false;
    }
    return result;
}

function validateLogin() {
    var email = document.getElementById("email").value;

    var result = true;

    if (!validateEmail(email)) {
        alert("Invalid Email");
        result = false;
    }
    return result;
}

//this will return true if the email is valid
function validateEmail(email) {
    var emailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\"[^\s@]+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email.match(emailformat))
        return false;
    return true;
}

//function for validating if there is no text entered
function validateEntry() {
    var noTexterr = document.getElementById("err");
    var text = document.getElementById("textField").value;

    if (text == "" || text == null) {
        noTexterr.style.display = "block";
        return false;
    }
    return true;
}

//event listener for search button click
var searchActivate = false;
document.getElementById("searchbtn").addEventListener("click", function() {
    if (!searchActivate) {
        document.getElementById("searchfield2").style.display = "initial";
        searchActivate = true;
    } else {
        document.getElementById("searchfield2").style.display = "none";
        searchActivate = false;
    }
});