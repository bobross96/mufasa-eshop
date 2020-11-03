
let purchaseQty = document.getElementById('purchaseQty');
let stock = document.getElementById('stock');
let submitButton = document.getElementById('submitButton');

purchaseQty.addEventListener('change',checkForStock,false)




function checkForStock(e){
    let currentQty = parseInt(e.target.value)
    if (currentQty > parseInt(stock.textContent)){
        submitButton.disabled = true
        alert('Selected quantity exceeds current stock level. Please try again.')
    }

    else {
        submitButton.disabled = false
    }

    


   
}