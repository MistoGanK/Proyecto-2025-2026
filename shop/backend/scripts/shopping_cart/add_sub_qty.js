document.addEventListener("DOMContentLoaded", () => {
  const btn_add_qty = document.querySelectorAll(".btn_add_qty");
  const btn_sub_qty = document.querySelectorAll(".btn_sub_qty");
  const endPointModifyQty = "/student022/shop/backend/endpoints/carts/cartsUpdateQty.php";

  console.log(stock_field);

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
    const endPoint = endPointModifyQty + "?qty=" + valueQty + "&id=" + id_product;
    http.open("GET", endPoint , true);
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
    id_product = e.target.getAttribute('id');
      if (
        parseInt(
          btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML
        ) == 1
      ) {
      } else {
        qty = parseInt(
          btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML
        );
        qty -= 1;
        btn_sub.parentElement.nextElementSibling.nextElementSibling.innerHTML =
          qty;
        modifyQty(qty);
      }
    });
  });

  // add qty product
  btn_add_qty.forEach((btn_add_qty) => {
    btn_add_qty.addEventListener("click", (e) => {
    id_product = e.target.getAttribute('id');
        qty = parseInt(
          btn_add_qty.parentElement.nextElementSibling.nextElementSibling.innerHTML
        );
        qty += 1;
        btn_add_qty.parentElement.nextElementSibling.nextElementSibling.innerHTML =
          qty;
        console.log(qty);
        modifyQty(qty);
    });
  });

});
