// Email format: contains only alphabets or dot or dashes.
validateEmail = () => {
    var email = document.getElementById("email").value.trim();
    if (email.length) {
        var re = /^([\w\.-])+@([\w\.])+$/;
        if (re.test(email))
            return true;
        else {
            alert("Email entered in wrong format.");
            return false;
        }
    }
    return false;
}

// Name format: contains 2 to 30 alphabets or spaces.
validateName = () => {
    var re = /^[a-zA-Z ]{2,30}$/;
    if (!re.test(document.getElementById("name").value.trim())) {
        alert("Please only enter alphabets and spaces");
        return false;
    }
    return true;
}

// Password format: contains at least 6 characters.
validatePwd = () => {
    var pwd = document.getElementById("password");
    if (pwd.value.length >= 6) {
        if (document.getElementById("secondpassword").value) {
            validateSecPwd();
        }
    } else {
        alert("Password must be at least 6 characters long!");
        return false;
    }
    return true;
}

// Password format: must be identical to the first password input.
validateSecPwd = () => {
    var pwd = document.getElementById("password");
    var pwdSec = document.getElementById("secondpassword");
    if (!pwd.value || (pwdSec.value != pwd.value)) {
        alert("Password mismatch! Please check again.");
        return false;
    }
    return true;
}

// Address format: must only contain alphabets, dots, spaces or dashes.
validateAddress = () => {
    var re = /^[\w\.\s-])+$/;
    if (!re.test(document.getElementById("address").value.trim())) {
        return false;
    }
    return true;
}

// Postal code foramt: must be strictly 6 digits long.
validatePostalCode = () => {
    var pcode = document.getElementById("postal").value.trim();
    var re = /^[0-9]{6}$/;
    if (!re.test(pcode)) {
        alert("Six digits only!");
        return false;
    }
    return true;
}

// Phone number format: must be from 8 to 12 digits long.
validatePhone = () => {
    var phoneno = document.getElementById("phone").value.trim();
    var re = /^[0-9]{8,12}$/;
    if (!re.test(phoneno)) {
        alert("Phone number should be in 8-12 digits");
        return false;
    }
    return true;
}

validateUser = () => validateEmail() && validatePwd() && validateSecPwd();

validateRegister = () => validateUser() && validateName();

validateCheckout = () => validateName() && validatePhone() && validateAddress() && validatePostalCode();