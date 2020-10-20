let plusButton = document.querySelectorAll('.plusButton')
let minusButton = document.querySelectorAll('.minusButton')
let qtyInput = document.querySelectorAll('.qtyInput')


qtyInput.forEach(input => {
    input.addEventListener('change',updatePrice,false)
})

minusButton.forEach(button => {
    button.addEventListener('click',minusQty,false)    
});

plusButton.forEach(button => {
    button.addEventListener('click',plusQty,false)    
});

function updatePrice(e){
    console.log(e.target.value);
    let newQty = e.target.value
    let id = e.target.id
    let price = document.getElementById('input' + id)
    let currentPrice = document.getElementById('price' +id)
    let totalPrice = document.getElementById('totalPrice')
    let oldPrice = parseInt(currentPrice.textContent.slice(1))
    currentPrice.textContent = '$' + price.value*newQty
    let diffPrice = price.value*newQty - oldPrice
    totalPrice.textContent = '$' + (parseInt(totalPrice.textContent.slice(1)) + diffPrice)
}

function plusQty(e) {
    //extract the id from buttonPlusxx
    let id = e.target.id.slice(10)
    let input = document.getElementById(id)
    let price = document.getElementById('input' + id)
    let currentPrice = document.getElementById('price' +id)
    let oldPrice = parseInt(currentPrice.textContent.slice(1))
    let totalPrice = document.getElementById('totalPrice')
    input.value++
    let diffPrice = price.value*parseInt(input.value) - oldPrice
    currentPrice.textContent = '$' + price.value*parseInt(input.value)
    totalPrice.textContent = '$' + (parseInt(totalPrice.textContent.slice(1)) + diffPrice)


    
}

function minusQty(e) {
    //extract id from buttonMinusxx
    let id = e.target.id.slice(11)
    let input = document.getElementById(id)
    let price = document.getElementById('input' + id)
    let currentPrice = document.getElementById('price' +id)
    let oldPrice = parseInt(currentPrice.textContent.slice(1))
    let totalPrice = document.getElementById('totalPrice')
    if (input.value > 1){
    input.value--
    let diffPrice = price.value*parseInt(input.value) - oldPrice
    currentPrice.textContent = '$' + price.value*parseInt(input.value)
    totalPrice.textContent = '$' + (parseInt(totalPrice.textContent.slice(1)) + diffPrice)
}
    
}


