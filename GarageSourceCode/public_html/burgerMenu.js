//html references
const section = document.getElementById('content');
const burgerMenu = document.getElementById('burgerMenu');
const burgerIcon = document.getElementById('burgerIcon');

//default value
let isBurgerMenuActive = false;

//menu toggle function
function toggleBurgerMenu(){
    switch (isBurgerMenuActive) {
        case false:
            burgerIcon.classList.add('burger-icon-opened')
            section.classList.add('hide')
            burgerMenu.classList.remove('hide')
            isBurgerMenuActive = true;
        break;
        case true:
            burgerIcon.classList.remove('burger-icon-opened')
            section.classList.remove('hide')
            burgerMenu.classList.add('hide')
            isBurgerMenuActive = false;
        break;
    }
}

//close menu on window width change
addEventListener('resize',(e)=>{ 
    burgerIcon.classList.remove('burger-icon-opened')
    section.classList.remove('hide')
    burgerMenu.classList.add('hide')
    isBurgerMenuActive = false;
});