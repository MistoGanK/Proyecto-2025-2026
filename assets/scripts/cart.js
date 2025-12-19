document.addEventListener('DOMContentLoaded', (e) =>{
// HTML elements 
const cart_form = document.querySelector('.cart_form');


// Prevent default form behaviour
cart_form.addEventListener('submit',(e)=>{
  e.preventDefault();
  console.log("holas");
})


});