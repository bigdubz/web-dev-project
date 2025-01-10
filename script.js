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