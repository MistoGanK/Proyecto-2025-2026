//  Ensure content HTML elements are fits loaded
document.addEventListener('DOMContentLoaded',(e)=>{

//<--- HTML elements declaration --->

//HTML containers
const dropdown_menu_container = document.querySelector('.dropdown_menu_container');
const dropdown_menu_container_backpacks = document.querySelector('.dropdown_menu_container_backpacks');
const dropdown_menu_container_bags = document.querySelector('.dropdown_menu_container_bags');
const dropdown_menu_container_about = document.querySelector('.dropdown_menu_container_about');

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
}
// Buttons events

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

});