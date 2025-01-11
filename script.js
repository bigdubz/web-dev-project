function validate() {
    var pwd = document.getElementById("pwd").value;
    var conf = document.getElementById("confpwd").value;

    if (pwd == conf) {
        document.getElementById("submit").removeAttribute("disabled");
        document.getElementById("pwd-conf-warning").setAttribute("hidden", "hidden");
    }
    else {
        document.getElementById("submit").setAttribute("disabled", "disabled");
        document.getElementById("pwd-conf-warning").removeAttribute("hidden");
    }
}

function validate_change_password() {
    var pwd = document.getElementById("change-pwd").value;
    var conf = document.getElementById("conf-change-pwd").value;

    if (pwd == conf) {
        document.getElementById("submit-change-pwd").removeAttribute("disabled");
        document.getElementById("change-pwd-conf-warning").setAttribute("hidden", "hidden");
    }
    else {
        document.getElementById("submit-change-pwd").setAttribute("disabled", "disabled");
        document.getElementById("change-pwd-conf-warning").removeAttribute("hidden");
    }
}

function show_sign_up_confirmation_button() {
    var button = document.getElementById('sign-up-button');
    var confirm_button = document.getElementById('sign-up-confirm');
    button.setAttribute("hidden", "hidden");
    confirm_button.removeAttribute("hidden");
}

function show_withdraw_confirmation_button() {
    var button = document.getElementById('withdraw-button');
    var confirm_button = document.getElementById('withdraw-confirm');
    button.setAttribute("hidden", "hidden");
    confirm_button.removeAttribute("hidden");
}

function show_delete_confirmation_button() {
    var button = document.getElementById('delete-event-button');
    var confirm_button = document.getElementById('delete-event-confirm');
    button.setAttribute("hidden", "hidden");
    confirm_button.removeAttribute("hidden");
}

function show_change_password_form() {
    var div = document.getElementById("change-password");
    var div2 = document.getElementById("change-email");
    div.toggleAttribute("hidden");
    div2.setAttribute("hidden", "hidden");
}

function show_change_email_form() {
    var div = document.getElementById("change-email");
    var div2 = document.getElementById("change-password");
    div.toggleAttribute("hidden");
    div2.setAttribute("hidden", "hidden");
}
