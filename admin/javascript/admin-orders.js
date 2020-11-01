function formChange(id){
    hiddenInput = document.getElementById("id"+id)
    
    hiddenInput.value = parseInt(id)
    console.log(hiddenInput);
    document.getElementById('submitForm'+id).submit()
}