document.addEventListener("DOMContentLoaded", () => {
  const btn_add_qty = document.querySelectorAll(".btn_add_qty");
  const btn_sub_qty = document.querySelectorAll(".btn_sub_qty");
  const p_subtotal = document.getElementById('p_subtotal');
  
  // NOTE: stock_field is not defined here, it might cause an error, best to remove it or define it.
  // console.log(stock_field); 

  const endPointModifyQty = "/student022/backend/endpoints/carts/cartsUpdateQty.php";

  let id_product;

  // Function to handle the AJAX call and update subtotal
  function modifyQty(valueQty, productId) {
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        // Ensure the response is formatted correctly before updating the innerHTML
        p_subtotal.innerHTML = parseFloat(this.response).toFixed(2);
        // --- EXTRA: Update individual item subtotal (UX Improvement) ---
        // Find the element displaying the individual subtotal (assuming you add an ID later)
        // For now, focus on the total.
      };
    };
    const endPoint = endPointModifyQty + "?qty=" + valueQty + "&id=" + productId;
    http.open("GET", endPoint , true);
    http.send();
  };

  // Function to safely get the current quantity element
  function getQtyElement(productId) {
    return document.getElementById('qty_' + productId);
  }

  // Event listeners

  // Subtract qty product
  btn_sub_qty.forEach((btn_sub) => {
    btn_sub.addEventListener("click", (e) => {
      id_product = e.target.getAttribute('id');
      const qtyElement = getQtyElement(id_product);
      let currentQty = parseInt(qtyElement.innerHTML);

      if (currentQty > 1) { // We prevent quantity from dropping below 1
        currentQty -= 1;
        qtyElement.innerHTML = currentQty;
        modifyQty(currentQty, id_product);
      } 
      // Si la cantidad es 1, no hacemos nada (el botón de eliminar se usaría para quitarlo).
    });
  });

  // Add qty product
  btn_add_qty.forEach((btn_add) => {
    btn_add.addEventListener("click", (e) => {
      id_product = e.target.getAttribute('id');
      const qtyElement = getQtyElement(id_product);
      let currentQty = parseInt(qtyElement.innerHTML);
      
      currentQty += 1;
      qtyElement.innerHTML = currentQty;
      
      // Update quantity in DB and refresh total
      modifyQty(currentQty, id_product);
    });
  });

});