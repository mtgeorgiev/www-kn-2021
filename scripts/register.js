
const onSubmit = event => {
    event.preventDefault();
    clearFormErrors();

    const email = event.target.querySelector('input[name="email"]').value;

    const password = event.target.querySelector('input[name="password"]').value;

    const passwordAgain = event.target.querySelector('input[name="password-again"]').value;

    const formErrors = getFormErrors(email, password, passwordAgain);

    if (formErrors.length > 0) {
        displayErrors(formErrors);
    } else {
        sendRegisterDataToServer({
            email: email,
            password: password
        });
    }
}

const getFormErrors = (email, password, passwordAgain) => {

    let errors = [];

    if (password != passwordAgain) {
        errors.push("Двете пароли не съвпадат");
    }

    return errors;
}

const clearFormErrors = () => {
    const errorMessageContainer = document.getElementById('error-message');
    errorMessageContainer.innerText = '';
    errorMessageContainer.setAttribute('style', 'display:none');
}

/**
 * Displays errors on submitted form
 * 
 * @param {*} errorMessages array of error messages as strings
 */
const displayErrors = errorMessages => {
    const errorMessageContainer = document.getElementById('error-message');

    errorMessages.map(errorMessage => {
            const element = document.createElement('div');
            const text = document.createTextNode(errorMessage);
            element.appendChild(text);
            return element;
        })
        .forEach(errorElement => {
            errorMessageContainer.appendChild(errorElement);
        });

    errorMessageContainer.setAttribute('style', 'display:block');
}

const sendRegisterDataToServer = data => {
    
    fetch('./endpoints/user.php', {
        method: 'POST',
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(handleRegisterResponse);

}

const handleRegisterResponse = response => {
    console.log(response);
}

document.querySelector('#register-container form').addEventListener('submit', onSubmit);
