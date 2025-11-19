document.addEventListener("DOMContentLoaded", () => {
  const btn_add_qty = document.querySelectorAll(".btn_add_qty");
  const btn_sub_qty = document.querySelectorAll(".btn_sub_qty");
  const endPointModifyQty = "/student022/shop/backend/endpoints/products/productSearch.php/";

  let id_product;
  let qty;

  // Functions 
  // Modify qty on db
  function modifyQty(valueQty){
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){

      };
    };
    http.open("GET", endPointModifyQty + "?productName=" + inputSearchValue, true);
    http.send();
  };

  // Event listeners

  // Add qty product
  btn_add_qty.forEach((btn_add) => {
    btn_add.addEventListener("click", (e) => {});
  });

  // Substract qty product
  btn_sub_qty.forEach((btn_sub) => {
    btn_sub.addEventListener("click", (e) => {
      if (
        parseInt(
          btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML
        ) == 1
      ) {
      } else {
        console.log(
          btn_sub.parentElement.nextElementSibling.nextElementSibling
        );
        qty = parseInt(
          btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML
        );
        qty -= 1;
        btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML =
          qty;
        console.log(qty);
      }
    });
  });

  // add qty product
  btn_add_qty.forEach((btn_add_qty) => {
    btn_add_qty.addEventListener("click", (e) => {
      console.log(btn_add_qty.parentElement.nextElementSibling.nextElementSibling);
      console.log("parent",btn_add_qty.parentElement.parentElement.parentElement);
        console.log(
          btn_add_qty.parentElement.nextElementSibling.nextElementSibling
        );
        qty = parseInt(
          btn_add_qty.parentElement.nextElementSibling.nextElementSibling.innerHTML
        );
        qty += 1;
        btn_add_qty.parentElement.nextElementSibling.nextElementSibling.innerHTML =
          qty;
        console.log(qty);
    });
  });

});
