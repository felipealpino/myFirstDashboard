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
 * Sorts a HTML table
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