function checkName(event) {
    const input = event.currentTarget;
        if (formStatus[input.name] = input.value.length > 0) {
            input.parentNode.parentNode.classList.remove('errorj');
        } else {
            input.parentNode.parentNode.classList.add('errorj');
        }
    
        checkForm();
}

function jsonCheckUsername(json) {
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
    }
    checkForm();
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
    checkForm();
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = event.currentTarget;

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.parentNode.parentNode.classList.add('errorj');
        formStatus.username = false;
        checkForm();
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
        checkForm();
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = event.currentTarget;
    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
    if (formStatus.password = (passwordInput.value.length >= 8 && regularExpression.test(passwordInput.value))) {
        document.querySelector('.password').classList.remove('errorj');
    } else {
        document.querySelector('.password').classList.add('errorj');
    }
    checkForm();
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = event.currentTarget;
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
    } else {
        document.querySelector('.confirm_password').classList.add('errorj');
    }
    checkForm();
}


function checkForm() {
    // Controlla consenso dati personali, che i campi siano pieni e che non siano false
    if(document.querySelector('.allow input').checked && Object.keys(formStatus).length === 7 && !Object.values(formStatus).includes(false)){
        document.getElementById('submit').disabled = false;
    }
    else{
        document.getElementById('submit').disabled = true;
    }
}

const formStatus = {'upload': true};
document.querySelector('.name input').addEventListener('blur', checkName); 
document.querySelector('.surname input').addEventListener('blur', checkName);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkForm);
document.querySelector('.submit input').addEventListener('change', checkForm);