// console.log(input_search);
console.log("hola");
const endPointProductSelect = "/student022/shop/backend/endpoints/products/productSearch.php/";
function searchProduct(inputSearchValue){
  
  // Empty search bar
  if (inputSearchValue.length == 0){
    // Retrieve all products
    
  }else{
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        document.getElementById('search').innerHTML = this.responseText;
      }
      // http.open("GET", endPointProductSelect + "?productName=" + inputSearhValue, true);
      http.open("GET", "productSearch.php?productName=" + inputSearchValue, true);
      http.send();
    }
  }
}

