//  Ensure content HTML elements are fits loaded
document.addEventListener('DOMContentLoaded',(e)=>{

//<--- HTML elements declaration --->

//HTML containers
const dropdown_menu_container = document.querySelector('.dropdown_menu_container');
const dropdown_menu_container_backpacks = document.querySelector('.dropdown_menu_container_backpacks');
const dropdown_menu_container_bags = document.querySelector('.dropdown_menu_container_bags');
console.log(dropdown_menu_container_bags);
const dropdown_menu_container_about = document.querySelector('.dropdown_menu_container_about');

// HTML buttons
const dropdown_button_show = document.getElementById('dropdown_button_show');
const dropdown_button_close = document.getElementById('dropdown_button_close');
const button_forward_backpacks = document.getElementById('button_forward_backpacks');
const button_forward_bags = document.getElementById('button_forward_bags');
console.log(button_forward_bags);
const button_forward_about = document.getElementById('button_forward_about');

//<--- Functions ---> 
function toggleDropDownMenu(){
    dropdown_menu_container.classList.toggle('show')
}
function toggleDropDownMenuBackpacks(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_backpacks.classList.toggle('show');
}
function toggleDropDownMenuBags(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_bags.classList.toggle('show');
    console.log("helo");
}
function toggleDropDownMenuAbout(){
    dropdown_menu_container.classList.toggle('show');
    dropdown_menu_container_about.classList.toggle('show');
}
//<--- Event listeners --->

// Buttons events

// Dropdown buttons
dropdown_button_show.addEventListener('click',toggleDropDownMenu);
dropdown_button_close.addEventListener('click',toggleDropDownMenu);

button_forward_backpacks.addEventListener('click',toggleDropDownMenuBackpacks);
button_forward_bags.addEventListener('click',toggleDropDownMenuBags);
button_forward_about.addEventListener('click',toggleDropDownMenuAbout);


});