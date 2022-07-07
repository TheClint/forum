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

// pour les boutons éditions
if(document.getElementById("activer-modification-profil")!=null){
const activerModificationProfil = document.getElementById("activer-modification-profil");
const elementsVisibles = document.getElementsByClassName("estVisible");
var estVisibleActive = false;

activerModificationProfil.addEventListener("click", ()=>{
    estVisibleActive=!estVisibleActive;
    for(elementVisible of elementsVisibles) {
        elementVisible.style.display = (estVisibleActive) ? "initial" : "none";
    }
});
}


const navCategorie = document.getElementById("nav-categorie");
const lienCategorie = document.getElementById("lien-categorie")
const rectLienCategorie = lienCategorie.getBoundingClientRect();


lienCategorie.addEventListener("mouseover", ()=>{
    const rectLienCategorie = lienCategorie.getBoundingClientRect();
    navCategorie.style.visibility = "visible";
    navCategorie.style.left = (rectLienCategorie.x - navCategorie.offsetWidth) + "px" ;
    navCategorie.style.top = rectLienCategorie.y + "px";
    navCategorie.style.display = "flex";
});
// récupération du token dans la balise méta
const metaTab = document.getElementsByTagName("meta");
let csrfToken = null;
for(let i=0; i<metaTab.length; i++){
    if(metaTab[i].getAttribute('name') == 'csrf-token'){
        csrfToken = metaTab[i].getAttribute('content');
        break;
    }
}

// pour les formulaires contre la faille CSRF
// ajout d'un input hidden csrfToken avec la valeur du token de la meta, juste avant que le submit ne submit
$( "form" ).on("submit", () => {
    let count = 0;
    while(document.forms.item(count)!= null){
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.value = csrfToken;
    hiddenInput.name = "csrfToken";
    document.forms.item(count).appendChild(hiddenInput);
    count++;
    }
return true;
});


// lienCategorie.addEventListener("mouseout", ()=>{
//     const rectLienCategorie = lienCategorie.getBoundingClientRect();

//     navCategorie.style.visibility = "hidden";
   
// });


// var estVisible = { menuBurgerWrapper : false, navCategorie : false};

// hideOnClickOutside(navCategorie);

// function hideOnClickOutside(element) {
//     const outsideClickListener = event => {
//         if (!element.contains(event.target) && estVisible[element]) { // or use: event.target.closest(selector) === null
//           element.style.display = 'none';
//           estVisible[element] = false;
//           removeClickListener();
//         }
//     }

//     const removeClickListener = () => {
//         document.removeEventListener('click', outsideClickListener);
//     }

//     document.addEventListener('click', outsideClickListener);
// }

// const isVisible = elem => !!elem && !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );

// console.log(isVisible);

