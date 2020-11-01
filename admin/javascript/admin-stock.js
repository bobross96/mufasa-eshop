let qtyInput = document.querySelectorAll(".stock-input");

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