// HTML elements
const p_subtotal = document.getElementById('p_subtotal');
const endPointSubTotal = "/student022/shop/backend/endpoints/carts/cartsUpdateQty.php";
let actualSubtotal;
console.log(p_subtotal.innerHTML);
actualSubtotal = parseInt(p_subtotal.innerHTML);

 // Modify qty on db
  function updateSubtotal(subtotal){
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
      };
      
    };
    const endPoint = endPointSubTotal + "?qty=" + valueQty + "&id=" + id_product;
    http.open("GET", endPoint , true);
    http.send();
    
  };

