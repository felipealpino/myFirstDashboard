/**
 * Função para abrir e fechar menu lateral
 */
const iconMobile = document.querySelector('.open-close-mobile-icon')
const leftSideBar = document.querySelector('.left-side-dashboard')
const topDashboard = document.querySelector('.top-dashboard')
iconMobile.addEventListener('click', function(){
    const isHide = leftSideBar.classList.contains("hide")

    if(isHide === true){
        leftSideBar.classList.remove("hide");
    } else {
        leftSideBar.classList.add("hide");
    }
});




/**
 * Função para marcar <li> do lado direito de cor diferente quando
 * estiver na aba selecionada 
 */
const itensLeftSideToSelect = document.querySelectorAll(".list-left-side ul li");
const txtTopSpan = document.querySelector(".top-dashboard span").innerText;
function checkMenuLeftSite(){
    itensLeftSideToSelect.forEach(item => {
        if((item.innerText).trim()  == (txtTopSpan).trim()){
            item.classList.add("selected");
        }
    });
}
checkMenuLeftSite();




/**
 * Função que faz sorting or reverse em uma table de HTML 
 * 
 * @param {HTMLtableElement} table the table to sort
 * @param {number} columnId the column index of the table to sort
 * @param {boolean} asc Determinate if the sort will be ascending or descending
 */
function sortTableByColumn(table, columnId, asc = true){
    const dirModifier = asc ? 1 : -1;
    const tBody = table.querySelector('#myTable');
    const rows = Array.from(tBody.querySelectorAll('tr'));


    //sort each row
    const sortedRows = rows.sort((a,b ) => {
        const aColText = a.querySelector(`td:nth-child(${columnId +1})`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${columnId +1})`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });


    // remove all existing tr's from the table 
    while(tBody.firstChild){
        tBody.removeChild(tBody.firstChild); 
    }

    // Re-ad the newly sorted row
    tBody.append(...sortedRows);

    // Remember how de column is currently sorted
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${columnId + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${columnId + 1})`).classList.toggle("th-sort-desc", !asc);
}

function ascendingAndDescending(){
    document.querySelectorAll(".table thead th").forEach(function(item,id){
        item.addEventListener('click', () => {
            var isDesc = item.classList.contains("th-sort-desc");
            sortTableByColumn(document.querySelector('table'), id, isDesc);
        });
    });
}


/**
 * Arrumando bug do left-side-dashboard
 */
window.addEventListener('resize', resizeLeftSide)
function resizeLeftSide(){
    const left = document.querySelector('.left-side-dashboard')
    const grid = document.querySelector('.content-dashboard-grid');
    const topContent = document.querySelector('.top-dashboard-mobile.left-icon')
    const rightSide = document.querySelector('.right-side-dashboard')

    try{
        var sum = topContent.clientHeight + grid.clientHeight;
        if(sum != left.clientHeight){
            left.style.height = sum+"px";
        }
    } catch{
        if(rightSide.clientHeight != left.clientHeight){
            left.style.height = rightSide.clientHeight+"px";
        }
    }
}
resizeLeftSide();

const userPopup = document.querySelector('.popup-usuarios');
function checkDisplayUsuarioList(event){
    event.preventDefault();
    const listarUsuario = document.querySelector('#listar_usuarios_link');
    if(userPopup.classList.contains("closepopup-usuarios")){
        userPopup.classList.remove("closepopup-usuarios")
    } else { 
        userPopup.classList.add("closepopup-usuarios");
    }
}

function closePopUpX(){
    userPopup.classList.add('closepopup-usuarios');
}