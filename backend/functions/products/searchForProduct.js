// console.log(input_search);
const endPointProductSelect = "/student022/shop/backend/endpoints/products/productSearch.php/";
function searchProduct(inputSearchValue){
  // Empty search bar
    // Retrieve all products
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        $jsonEndpoint = this.response;
      };
    };
    
  http.open("GET", endPointProductSelect + "?productName=" + inputSearchValue, true);
  http.send();
};

