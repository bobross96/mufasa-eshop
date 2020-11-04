let qtyInput = document.querySelectorAll(".stock-input");
let priceInput = document.querySelectorAll(".price-input");

let minusButton = document.querySelectorAll(".minusButton");
let plusButton = document.querySelectorAll(".plusButton");


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

priceInput.forEach((input) => {
  input.addEventListener("change",submitPrice,false)
})



qtyInput.forEach((input) => {
    input.addEventListener("change",submitQty,false)
})

function submitPrice(e){
    let id = e.target.id.slice(5)
    let updateForm = document.getElementById("updateForm" + id)
    let hiddenInput = document.getElementById("id"+id)
    hiddenInput.value = id
    if (e.target.value < 0){
      alert('price cannot be negative')
    }

    else {
      updateForm.submit()
    }
}


function submitQty(e){
    let id = e.target.id
    let updateForm = document.getElementById("updateForm" + id)
    let hiddenInput = document.getElementById("id"+id)
    hiddenInput.value = id  
    updateForm.submit()
}



function minusQty(e) {

  console.log(e);
  let id = e.target.id.slice(11);
  let updateForm = document.getElementById("updateForm" + id);
  console.log(id);
  let input = document.getElementById(id);
  let hiddenInput = document.getElementById("id"+id)
  hiddenInput.value = id
  if (input.value <= 0) {
    input.value = 0;
    updateForm.submit()
  } else {
    input.value--;
    updateForm.submit()
  }

}


function plusQty(e) {
    console.log(e);
    let id = e.target.id.slice(10);
    console.log(id);
    let updateForm = document.getElementById("updateForm" + id);
    let input = document.getElementById(id);
    let hiddenInput = document.getElementById("id"+id)
    hiddenInput.value = id
    input.value++
    updateForm.submit()
  }