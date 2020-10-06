function validateForm() {
    var password = $('#password').val();
    var confirmedPass = $('#cPass').val();
    var valid = false;

    if(password == confirmedPass){
        valid = true;
    }

    if(password.length< 6){
        alert("Need a password bigger than six characters");
        return false;
    }
    
    if (valid) {
        return true;

    } else if (!valid) {
        alert("Your passwords do not match");
        return false;

    }
}
