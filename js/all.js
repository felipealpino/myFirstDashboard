const iconMobile = document.querySelector('.open-close-mobile-icon')
const leftSideBar = document.querySelector('.left-side-dashboard')
iconMobile.addEventListener('click', function(){
    // const isHide = leftSideBar.classList.contains("hide")
    const mLeft = window.getComputedStyle(leftSideBar).getPropertyValue('margin-left')
    // console.log(mLeft)
    if(mLeft === "0px"){
        // leftSideBar.classList.add("hide");
        leftSideBar.style.marginLeft = "-250px"
    } else {
        leftSideBar.style.marginLeft = "0px"
    }
});