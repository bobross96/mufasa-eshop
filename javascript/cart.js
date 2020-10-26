
let qtyInput = document.querySelectorAll(".qtyInput");
let updateCart = document.getElementById("updateCart")
let minusButton = document.querySelectorAll(".minusButton")


qtyInput.forEach((input) => {
    console.log('poop');
    input.addEventListener("change", updatePrice, false);
});


minusButton.forEach((button) => {
    button.addEventListener("click",minusQty,false)
})





function updatePrice(e) {
    let id = e.target.id;
    // this will append value to the focusInput POST variable, so that
    // upon refresh of page, can get the id number to focus on 
    let focusInput = document.getElementById("change" + id);
    focusInput.value = id;
    updateCart.click()
    
}

function minusQty(e){
    let id = e.target.id.slice(11)
    let input = document.getElementById(id)
    if (input.value <= 1 ){
        input.value = 1
    } 
}





