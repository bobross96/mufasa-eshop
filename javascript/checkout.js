//regex code to validate the delivery address

confirmButton = document.getElementById('confirmPayment')
address = document.getElementById('address')
postalCode = document.getElementById('postalCode')

function validateAdd(address){
    
    var pos = address.search(/[^a-zA-Z\d\s\\#\-:]/)
    if (pos >= 0){
        alert(`Your address has invalid characters, please do not use special \n
        characters in your address`)
        confirmButton.disabled = true;
    }
    else {
        confirmButton.disabled = false;
    }

   
    
}




function validatePostalCode(postcode) {
    var pos = postcode.search(/^[0-9]{6}$/)
    if (pos != 0){
        alert(`Please input postal code that is of 6 digits`)
        confirmButton.disabled = true;
    }

    else {
        confirmButton.disabled = false;
    }

    
}