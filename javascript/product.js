
let purchaseQty = document.getElementById('purchaseQty');
let stock = document.getElementById('stock');
let submitButton = document.getElementById('submitButton');

purchaseQty.addEventListener('change',checkForStock,false)




function checkForStock(e){
    let currentQty = e.target.value
    if (currentQty > stock.textContent){
        submitButton.disabled = true
        alert('ordering more than stock')
    }

    else {
        submitButton.disabled = false
    }

    


   
}