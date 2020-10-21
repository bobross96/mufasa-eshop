
let qtyInput = document.querySelectorAll(".qtyInput");
let updateCart = document.getElementById("updateCart")
let minusButton = document.querySelectorAll(".minusButton")


qtyInput.forEach((input) => {
    input.addEventListener("change", updatePrice, false);
});


minusButton.forEach((button) => {
    button.addEventListener("click",minusQty,false)
})





function updatePrice(e) {
    let id = e.target.id;
    if (e.target.value <= 1 ){
        e.target.value = 1
        let minusButtonE = document.getElementById('buttonMinus'+id)
        minusButtonE.disabled = true
    }
    let newQty = e.target.value;
    let price = document.getElementById("input" + id);
    let currentPrice = document.getElementById("price" + id);
    let totalPrice = document.getElementById("totalPrice");
    let oldPrice = parseInt(currentPrice.textContent.slice(1));
    let blahem = document.getElementById("change" + id);
    currentPrice.textContent = "$" + price.value * newQty;
    let diffPrice = price.value * newQty - oldPrice;
    totalPrice.textContent =
        "$" + (parseInt(totalPrice.textContent.slice(1)) + diffPrice);
    blahem.value = id;
    updateCart.click()
    
}

function minusQty(e){
    let id = e.target.id.slice(11)
    let input = document.getElementById(id)
    if (input.value <= 1 ){
        input.value = 1
        let minusButtonE = document.getElementById('buttonMinus'+id)
        minusButtonE.disabled = true
    } 
}





