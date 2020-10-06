function validateForm() {
    var email = document.getElementById("email").value;
    var emailCheck = false;
    

    if (email.includes("@") && email.includes(".")) emailCheck = true;
    
    var password = document.getElementById("passwd").value;
    var passwordCheck = false;

    if (password.length >= 6) passwordCheck = true;
    
    if (emailCheck && passwordCheck) {
        return true;

    } else if (!emailCheck) {
        alert("Email must contain at least one '@' and at least one '.'.");
        return false;

    } else if (!passwordCheck) {
        alert("Password must be at least 6 characters long.");
        return false;
    }
}