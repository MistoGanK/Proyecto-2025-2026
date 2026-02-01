document.addEventListener("DOMContentLoaded", () => {
  const btn_add_qty = document.querySelectorAll(".btn_add_qty");
  const btn_sub_qty = document.querySelectorAll(".btn_sub_qty");
  // Global subtotal element
  const p_subtotal = document.getElementById('p_subtotal');
  const pre_p_subtotal = document.getElementById('pre_p_subtotal');
  
  const endPointModifyQty = "/student022/backend/endpoints/carts/cartsUpdateQty.php";

  // Function to safely retrieve the quantity element
  function getQtyElement(productId) {
    return document.getElementById('qty_' + productId);
  }
  
  // NEW FUNCTION: Get the individual item subtotal element
  function getItemSubtotalElement(productId) {
    return document.getElementById('subtotal_item_' + productId);
  }

  // Function to handle the AJAX call and update subtotal
  function modifyQty(valueQty, productId) {
    var http = new XMLHttpRequest();
    
    // JSON response
    http.responseType = 'json'; 

    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        const response = this.response;
        
        if (response.error) {
            console.error("Server Error:", response.error);
            alert("An error occurred while updating the cart.");
            return;
        }

        // 1. Get the reference to the individual item subtotal element
        const itemSubtotalElement = getItemSubtotalElement(productId);

        // 2. Update the Global Subtotal (from response.global_subtotal)
        p_subtotal.innerHTML = response.global_subtotal + ' €'; // Add currency symbol for presentation
        pre_p_subtotal.innerHTML = response.global_subtotal + ' €'; // Add currency symbol for presentation
        
        // 3. Update the Individual Item Subtotal (from response.item_subtotal)
        itemSubtotalElement.innerHTML = response.item_subtotal + ' €'; 
      };
    };
    const endPoint = endPointModifyQty + "?qty=" + valueQty + "&id=" + productId;
    http.open("GET", endPoint , true);
    http.send();
  };

  // Event listeners

  // Subtract quantity product
  btn_sub_qty.forEach((btn_sub) => {
    btn_sub.addEventListener("click", (e) => {
      const id_product = e.target.getAttribute('id');
      const qtyElement = getQtyElement(id_product);
      let currentQty = parseInt(qtyElement.innerHTML);
      
      if (currentQty > 1) { 
        currentQty -= 1;
        qtyElement.innerHTML = currentQty;
        modifyQty(currentQty, id_product);
      } 
    });
  });

  // Add quantity product
  btn_add_qty.forEach((btn_add) => {
    btn_add.addEventListener("click", (e) => {
      const id_product = e.target.getAttribute('id');
      const qtyElement = getQtyElement(id_product);
      let currentQty = parseInt(qtyElement.innerHTML);
      
      currentQty += 1;
      qtyElement.innerHTML = currentQty;
      
      modifyQty(currentQty, id_product);
    });
  });
});