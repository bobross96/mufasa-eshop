
let emailInput = document.getElementById('email')
let loginButton = document.getElementById('loginButton')

emailInput.addEventListener("change",validateEmail,false)


function validateEmail(event){
    emailToValidate = event.currentTarget 
    var pos = emailToValidate.value.search(/^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/)
    if (pos != 0){
        alert(`Your email : ${emailToValidate.value} is not correct form\n
        The email field contains a user name part follows by “@” and a domain name part.\n
        The user name contains word characters including hyphen (“-”) and period (“.”)\n
        The domain name contains two to four address extensions.\n
        Each extension is string of characters and separated from the others by a period (“.”).\n
        The last extension must have two to three characters\n
        for eg. bla@bla.bla.bla.bla`)
        loginButton.disabled = true;
    }
    else {
        loginButton.disabled = false;
    }
}