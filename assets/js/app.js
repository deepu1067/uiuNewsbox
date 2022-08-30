function validate() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("con-pass").value;
    if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}