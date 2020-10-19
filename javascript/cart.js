let plusButton = document.querySelectorAll('.plusButton')
let minusButton = document.querySelectorAll('.minusButton')

minusButton.forEach(button => {
    button.addEventListener('click',minusQty,false)    
});

plusButton.forEach(button => {
    button.addEventListener('click',plusQty,false)    
});


function plusQty(e) {
    let id = e.target.id.slice(-1)
    let input = document.getElementById(id)
    input.value++
    
}

function minusQty(e) {
    let id = e.target.id.slice(-1)
    let input = document.getElementById(id)
    input.value--
    
}


