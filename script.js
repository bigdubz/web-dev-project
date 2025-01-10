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

function show_confirmation_button() {
    var sign_up_button = document.getElementById("sign-up-button");
    var confirm_button = document.getElementById("sign-up-confirm");
    sign_up_button.setAttribute("hidden", "hidden");
    confirm_button.removeAttribute("hidden");
}