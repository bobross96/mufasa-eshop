
let addressInput = document.getElementById('addressInput')
let postalCodeInput = document.getElementById('postalCodeInput')
let emailInput = document.getElementById('emailInput')
let editAll = document.getElementById('editAll')

let submitButton = document.getElementById('submitButton')



addressInput.addEventListener('change',validateAddress,false)
postalCodeInput.addEventListener('change',validatePostalCode,false)
emailInput.addEventListener('change',validateEmail,false)
editAll.addEventListener('click',allowEditAll,false)

function allowEditAll(){
    addressInput.readOnly = false;
    postalCodeInput.readOnly = false;
    emailInput.readOnly = false;
    submitButton.style.display = 'block' 
}








function validateAddress(event){
    addressToValidate = event.currentTarget
    var pos = addressToValidate.value.search(/[^a-zA-Z\d\s\\#\-:]/)
    if (pos >= 0){
        alert(`Your address has invalid characters, please do not use special \n
        characters in ur address`)
        submitButton.disabled = true;
    }
    else {
        submitButton.disabled = false;
    }
    addressToValidate.focus()
    addressToValidate.select()
}



function validatePostalCode(event){
    postalCodeToValidate = event.currentTarget
    var pos = postalCodeToValidate.value.search(/^[0-9]{6}$/)
    if (pos != 0){
        alert(`please input postal code that is of 6 digits`)
        submitButton.disabled = true;
    }

    else {
        submitButton.disabled = false;
    }
    postalCodeToValidate.focus()
    postalCodeToValidate.select()
}

function validateEmail(event){
    console.log('poop');
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
        submitButton.disabled = true;
    }
    else {
        submitButton.disabled = false;
    }
}

