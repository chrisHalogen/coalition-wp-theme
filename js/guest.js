jQuery(document).ready(function ($) {
    if (document.querySelector("#nav-container")){
        // console.log("Ready");
        let menuToggle = document.querySelector(".menuToggle");
        let menu_container = document.querySelector('#nav-container');
        menuToggle.onclick = function (){
            menu_container.classList.toggle('active')
        }
    }
});