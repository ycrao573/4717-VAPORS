validateEmail = () => {
    var email = document.getElementById("email").value.trim();
    if(email.length){
        var re = /^([\w\.-])+@([\w\.])+$/;
        if(re.test(email))
            return true;
        else{
            alert("Email entered in wrong format.");
            return false;
        }
    }
    alert("Please fill in your email.");
    return false;
}

validateName = () =>{
    var re = /^[a-zA-Z ]{2,30}$/;
    if (!re.test(document.getElementById("name").value.trim())) {
        alert("Please only enter alphabets and spaces");
        return false;
    }
    return true;
}

validatePwd = () => {
    var pwd = document.getElementById("password");
    if (pwd.value.length >= 6) {
        if (document.getElementById("second-password").value) {
            validateSecPwd();
        }
    }else{
        alert("Password must be at least 6 characters long!");
        return false;
    }
    return true;
}

validateSecPwd = () => {
    var pwd = document.getElementById("password");
    var pwdSec = document.getElementById("second-password");
    if (!pwd.value || (pwdSec.value != pwd.value)) {
        return false;
    }
    return true;
}

validateAddress = () =>{
    var re = /^[\w\.\s-])+$/;
    if (!re.test(document.getElementById("address").value.trim())) {
        return false;
    }
    return true;
}

validatePostalCode = () =>{
    var pcode = document.getElementById("postal").value.trim();
    var re = /^[0-9]{6}$/;
    if (!re.test(pcode)) {
        showInvalidInput($('#postal'), "Six digits only!");
        return false;
    } else {
        hideInvalidInput($('#postal'));
        return true;
    }
}

validatePhone = () => {
    var phoneno = document.getElementById("phone").value.trim();
    var re = /^[0-9]{8,12}$/;
    if (!re.test(phoneno)) {
        showInvalidInput($('#phone'), "Phone number should be in 8 digits");
        return false;
    } else {
        hideInvalidInput($('#phone'));
        return true;
    }
}

validateUser = () => validateEmail() && validatePwd() && validateSecPwd();

validateRegister = () => validateUser() && validateName();

validateCheckout = () => validateName() && validatePhone() && validateAddress() && validatePostalCode();