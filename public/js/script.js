const menuBurger = document.getElementById("menu-burger");
const menuBurgerWrapper = document.getElementById("menu-burger-wrapper");

menuBurger.addEventListener("click", ()=>{
    if(!menuBurger.classList.contains("open")){
        menuBurger.className = "open";
        menuBurgerWrapper.classList.remove("none");
    }
    else{
        menuBurger.classList.remove("open");
        menuBurgerWrapper.className = "none";
        
    }
    

});
