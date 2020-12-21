//Fechar e abrir menu-esquerdo-lateral
const iconMobile = document.querySelector('.open-close-mobile-icon')
const leftSideBar = document.querySelector('.left-side-dashboard')
const topDashboard = document.querySelector('.top-dashboard')
iconMobile.addEventListener('click', function(){
    // const mLeft = window.getComputedStyle(leftSideBar).getPropertyValue('margin-left')
    // if(mLeft === "0px"){
    //     leftSideBar.style.marginLeft = "-250px"
    // } else {
    //     leftSideBar.style.marginLeft = "0px"
    // }
    const isHide = leftSideBar.classList.contains("hide")

    if(isHide === true){
        leftSideBar.classList.remove("hide");
    } else {
        leftSideBar.classList.add("hide");
    }
});

const cargaSelectValue = document.querySelector('select')
cargaSelectValue.addEventListener('click', changePlaceHolder)
function changePlaceHolder(){
    const selectValue = document.querySelector('select').value
    const buscarInput = document.getElementById('myInput')
    buscarInput.placeholder = `Buscar ${selectValue}`
}


//produtos_estoque_filter
// $(document).ready(function(){
//     $("#myInput").on("keyup", function() {
//       var value = $(this).val().toLowerCase();
//       $("#myTable tr").filter(function() {
//         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//       });
//     });
// });

