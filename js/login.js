"use strict";

function validate() {
    if (username.value === "") return;
    $.ajax({
        url: "php/login.php",
        data: {"username": username.value},
        success: function (user_exists) {
            $("#username").removeClass(login.checked == user_exists ? "invalid" : "valid");
            $("#username").addClass(login.checked == user_exists ? "valid" : "invalid");
            if (login.checked == user_exists && $("#password").hasClass("valid"))
                $("[name='action']").removeClass("disabled");
            else
                $("[name='action']").addClass("disabled");
        }
    });
}

function onPasswordBlur() {
    if ($("#username").hasClass("valid") && $("#password").hasClass("valid"))
        $("[name='action']").removeClass("disabled");
    else
        $("[name='action']").addClass("disabled");
}

function onLoginTypeChange() {
    $("[name='action']").html(login.checked ? "Login" : "Sign Up");
    $("[for='username']").attr("data-error", login.checked ? "Username Incorrect" : "Username Exists");
    $("[for='username']").attr("data-success", login.checked ? "Enter Password" : "Username Available");
    validate();
    Materialize.updateTextFields();
}

function onCancel() {
    setTimeout(function () {
        onLoginTypeChange();
        $("[name='action']").addClass("disabled");
        login.click();
    }, 200);
}

$(function () {
    login.setAttribute("onclick", "onLoginTypeChange()");
    signup.setAttribute("onclick", "onLoginTypeChange()");
    username.setAttribute("onblur", "validate()");
    password.setAttribute("onblur", "onPasswordBlur()");
    $("[type='reset']").attr("onclick", "onCancel()");
    $("[name='action']").addClass("disabled");
    login.click();
});
