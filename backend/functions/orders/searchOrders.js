const endPointProductSelect = "/student022/backend/endpoints/orders/ordersSearch.php";
console.log("Hola mi gente");
function searchProduct(inputSearchValue){
  // Empty search bar
    // Retrieve all products
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200){
        $jsonEndpoint = this.response;
        document.getElementById("orders_container").innerHTML = $jsonEndpoint;
      };
    };
    
  http.open("GET", endPointProductSelect + "?orderCode=" + inputSearchValue, true);
  http.send();
};
let targetDiv = document.getElementById("searchEndPointResult")
// Event listener
let searchInput = document.querySelector('input[type="search"]');
searchInput.addEventListener("input", (e)=>{
  searchProduct(searchInput.value)
})
