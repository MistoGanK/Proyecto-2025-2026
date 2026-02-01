// console.log(input_search);
const endPointProductSelect = "/student022/backend/endpoints/products/productSearch.php/";
const productSection = document.getElementById('productSection');
function searchProduct(inputSearchValue){
  // Empty search bar
    // Retrieve all products
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        productSection.innerHTML = this.response;
      };
    };
    
  http.open("GET", endPointProductSelect + "?productName=" + inputSearchValue, true);
  http.send();
};

