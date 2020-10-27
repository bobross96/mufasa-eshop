//regex code to validate the delivery address

confirmButton = document.getElementById('confirmPayment')


function validateAdd(address){
    
    var pos = address.search(/[^a-zA-Z\d\s\\#\-:]/)
    if (pos >= 0){
        alert(`Your address has invalid characters, please do not use special \n
        characters in ur address`)
        confirmButton.disabled = true;
    }
    else {
        confirmButton.disabled = false;
    }
    
}




function validatePostalCode(postcode) {
    var pos = postcode.search(/^[0-9]{6}$/)
    if (pos != 0){
        alert(`please input postal code that is of 6 digits`)
        confirmButton.disabled = true;
    }

    else {
        confirmButton.disabled = false;
    }
}