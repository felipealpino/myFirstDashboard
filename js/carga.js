const cargaSelectValue = document.querySelector('select')
function changePlaceHolder(){
    const selectValue = document.querySelector('select').value
    const buscarInput = document.getElementById('myInput')
    buscarInput.placeholder = `Buscar ${selectValue}`
}
cargaSelectValue.addEventListener('click', changePlaceHolder)




