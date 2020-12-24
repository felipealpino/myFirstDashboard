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
