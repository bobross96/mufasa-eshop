let qtyInput = document.querySelectorAll(".qtyInput");
let updateCart = document.getElementById("updateCart");
let minusButton = document.querySelectorAll(".minusButton");
let plusButton = document.querySelectorAll(".plusButton");


window.scrollBy(0, -500);

/* qtyInput.forEach((input) => {
  console.log("poop");
  input.addEventListener("change", updatePrice, false);
}); */



minusButton.forEach((button) => {
  button.addEventListener("click", minusQty, false);
});

plusButton.forEach((button) => {
    button.addEventListener("click", plusQty, false);
});



function minusQty(e) {
  console.log(e);
  let id = e.target.id.slice(11);
  console.log(id);
  let input = document.getElementById(id);
  if (input.value <= 1) {
    input.value = 1;
  } else {
    input.value--;
  }
}


function plusQty(e) {
    console.log(e);
    let id = e.target.id.slice(10);
    console.log(id);
    let input = document.getElementById(id);
    input.value++
    updatePrice(id)
  }


function updatePrice(e) {
  console.log('price changed');
  console.log(e);
  let id = e
  // this will append value to the focusInput POST variable, so that
  // upon refresh of page, can get the id number to focus on
  let focusInput = document.getElementById("change" + id);
  focusInput.value = id;
  //check for the stock value based on the id!
  let stock = document.getElementById("stock"+id)
  //new value based on user input
  let input = document.getElementById(id)

  //make sure stock is more than user value
  if (parseInt(input.value) > parseInt(stock.value)){

    alert('Ordering more than available stock. Max Qty based on stock will be selected')
    input.value = stock.value
    updateCart.click()
  }

  else {
    
    updateCart.click();
  }
  

  
}

/* function minusQty(e){
    let id = e.target.id.slice(11)
    let input = document.getElementById(id)
    if (input.value <= 1 ){
        input.value = 1
    } 
} */
