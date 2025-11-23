//  Ensure content HTML elements are fits loaded
document.addEventListener('DOMContentLoaded',(e)=>{

// href
    // Favorite Icons ref
const iconFavEmpty = '/assets/icons/favorite_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp';
const iconFavFill = '/assets/icons/favorite_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp';
    // Like/Dislike ref
const iconLikedEmpty = '/assets/icons/thumb_up_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp';
const iconDislikedEmpty = '/assets/icons/thumb_down_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp';
const iconLikedFilled = '/assets/icons/thumb_up_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp';
const iconDislikedFilled = '/assets/icons/thumb_down_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp;'
//<--- HTML elements declaration --->

//HTML containers
const dropdown_menu_container = document.querySelector('.dropdown_menu_container');
const dropdown_menu_container_backpacks = document.querySelector('.dropdown_menu_container_backpacks');
const dropdown_menu_container_bags = document.querySelector('.dropdown_menu_container_bags');
const dropdown_menu_container_about = document.querySelector('.dropdown_menu_container_about');
const product_form = document.querySelector('.product_form');

const product_color_item = document.querySelectorAll('.product_color_item');
product_color_item[0].classList.toggle('selected_color') // Pre select Default
// HTML buttons

// Dropdown menu
const dropdown_button_show = document.getElementById('dropdown_button_show');
const dropdown_button_close = document.getElementById('dropdown_button_close');
const button_forward_backpacks = document.getElementById('button_forward_backpacks');
const button_forward_bags = document.getElementById('button_forward_bags');
const button_forward_about = document.getElementById('button_forward_about');

// Dropdown Backpacks
const button_backwards_backpacks = document.getElementById('button_backwards_backpacks');
const dropdown_backpacks_button_close = document.getElementById('dropdown_backpacks_button_close');
// Dropdown Bags
const button_backwards_bags = document.getElementById('button_backwards_bags');
const dropdown_bags_button_close = document.getElementById('dropdown_bags_button_close');
// Dropdown About
const button_backwards_about = document.getElementById('button_backwards_about');
const dropdown_about_button_close = document.getElementById('dropdown_about_button_close');

// Favorite button
const fav_button = document.getElementsByClassName('fav_button'); // Home

const button_add_to_fav = document.querySelector('.button_add_to_fav'); // Product Details
const imgFav = document.getElementById('imgFav');
// Buy & Cart
const button_product_buy = document.getElementById('button_product_buy');
const button_product_cart = document.getElementById('button_product_buy');

// Color buttons
const buttom_color_item = document.querySelectorAll('.buttom_color_item');

// Togle info 
const product_toggle_button = document.querySelectorAll('.product_toggle_button');
console.log(product_toggle_button);

// Review buttons
const button_like = document.querySelectorAll('.button_like');
const button_dislike = document.querySelectorAll('.button_dislike');

//<--- Functions ---> 
function toggleDropDownMenu(){
    dropdown_menu_container.classList.toggle('show')
};

function toggleDropDownMenuBackpacks(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_backpacks.classList.toggle('show');
};
function closeDropDownMenuBackpacks(){
    dropdown_menu_container_backpacks.classList.toggle('show');
}

function toggleDropDownMenuBags(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_bags.classList.toggle('show');
};
function closeDropDownMenuBags(){
    dropdown_menu_container_bags.classList.toggle('show');
}

function toggleDropDownMenuAbout(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_about.classList.toggle('show');
};
function closeDropDownMenuAbout(){
    dropdown_menu_container_about.classList.toggle('show');
};
function togleSelectedColor(event){
    // Remove all other borders
    if(product_color_item !== null && product_color_item.length > 0){
        product_color_item.forEach((color_img)=>{
            color_img.classList.remove('selected_color');
        });
        event.currentTarget.parentNode.classList.toggle('selected_color');
    }
}
function toggleFavorite (){
        // Detect if filled 
        if (imgFav.src.includes('FILL0')){
            imgFav.src = iconFavFill;
        }else{
            imgFav.src = iconFavEmpty;
        }
};
function togleProductInfo(event){
    const targetButton = event.currentTarget;
    targetButton.nextElementSibling.classList.toggle('show');

    const pElement = targetButton.querySelector('p');
    
    if (pElement.innerHTML === '-') {
        pElement.innerHTML = '+';
    } else {
        pElement.innerHTML = '-';
    }
};

function toggleLikeReview(event){
    const targetButton = event.currentTarget;
    const siblingButton = targetButton.nextElementSibling;
    const siblingImg = siblingButton.querySelector('.dislike_img');
    const targetImg = targetButton.querySelector('.like_img');
    const pElement = targetButton.querySelector('p');
    if (targetImg.src.includes('FILL0')){
        targetImg.src = iconLikedFilled;
        siblingImg.src = iconDislikedEmpty;
        let currentLikes = parseInt(pElement.textContent);
        currentLikes +=1;
        pElement.innerHTML = currentLikes;
    }else{
        targetImg.src = iconLikedEmpty;
        let currentLikes = parseInt(pElement.textContent);
        currentLikes -=1;
        pElement.innerHTML = currentLikes;
    }   
};

function toggleDislikeReview(event){
    const targetButton = event.currentTarget;
    const siblingButton = targetButton.previousElementSibling;
    const siblingImg = siblingButton.querySelector('.like_img');
    const targetImg = targetButton.querySelector('.dislike_img');
    const pElement = targetButton.querySelector('p');
    if (targetImg.src.includes('FILL0')){
        targetImg.src = iconDislikedFilled;
        siblingImg.src = iconLikedEmpty;
        let currentLikes = parseInt(pElement.textContent);
        currentLikes -=1;
        pElement.innerHTML = currentLikes;
    }else{
        targetImg.src = iconDislikedEmpty;
        let currentLikes = parseInt(pElement.textContent);
        currentLikes +=1;
        pElement.innerHTML = currentLikes;
    }
};

function detectFavoriteClick(event){
    console.log("holoa");
    console.log(event);
    // Detect which button was clicked
    const buttonClick = event.currentTarget;
    // Detected the img
    const icon = buttonClick.querySelector('img');

    // Detect if filled or not 
    if (icon.classList.contains('empty')){
        icon.src = iconFavFill;
        icon.classList.remove('empty');
    }else{
        icon.src = iconFavEmpty;
        icon.classList.remove('empty');
    }
};
// Buttons events

// Form 
product_form.addEventListener('click',(e)=>{
    e.preventDefault();
})

// Dropdown buttons
dropdown_button_show.addEventListener('click',toggleDropDownMenu);
dropdown_button_close.addEventListener('click',toggleDropDownMenu);

button_forward_backpacks.addEventListener('click',toggleDropDownMenuBackpacks);
button_forward_bags.addEventListener('click',toggleDropDownMenuBags);
button_forward_about.addEventListener('click',toggleDropDownMenuAbout);

// Dropdown buttons backpacks
button_backwards_backpacks.addEventListener('click',toggleDropDownMenuBackpacks);
dropdown_backpacks_button_close.addEventListener('click',closeDropDownMenuBackpacks);

// Dropdown buttons bags
button_backwards_bags.addEventListener('click',toggleDropDownMenuBags);
dropdown_bags_button_close.addEventListener('click',closeDropDownMenuBags);

// Dropdwon buttons about
button_backwards_about.addEventListener('click',toggleDropDownMenuAbout);
dropdown_about_button_close.addEventListener('click',closeDropDownMenuAbout);

// Product Details add fav
button_add_to_fav.addEventListener('click',toggleFavorite);

// Colors Buttons
buttom_color_item.forEach((buttonColor)=>{
    buttonColor.addEventListener('click',togleSelectedColor);
})
// buttom_color_item.addEventListener('click',togleSelectedColor);
product_toggle_button.forEach((e)=>{
    e.addEventListener('click',togleProductInfo);
});
button_like.forEach((e)=>{
    e.addEventListener('click',toggleLikeReview);
});
button_dislike.forEach((e)=>{
    e.addEventListener('click',toggleDislikeReview);
})
Array.from(fav_button).forEach(button => {
    button.addEventListener('click', detectFavoriteClick);
});

});