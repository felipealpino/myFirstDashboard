/**
 * Função que captura valor do ComboBox e escreve no InputBox
 */
const cargaSelectValue = document.querySelector('select')
function changePlaceHolder(){
    const selectValue = document.querySelector('select').value
    const buscarInput = document.getElementById('myInput')
    buscarInput.placeholder = `Buscar ${selectValue}`
}
cargaSelectValue.querySelectorAll('option').forEach(element => {
    element.addEventListener('mouseover', console.log(element));
});





