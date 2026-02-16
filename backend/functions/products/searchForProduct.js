// console.log(input_search);
const endPointProductSelect =
  "/student022/backend/endpoints/products/productSearch.php";
function searchProduct(inputSearchValue) {
  // Empty search bar
  // Retrieve all products
  var http = new XMLHttpRequest();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      jsonEndpoint = this.response;
      document.getElementById("products_container").innerHTML = jsonEndpoint;
    }
  };

  http.open(
    "GET",
    endPointProductSelect +
      "?productName=" +
      encodeURIComponent(inputSearchValue),
    true,
  );
  http.send();
}
let targetDiv = document.getElementById("searchEndPointResult");
// Event listener
let searchInput = document.querySelector('input[type="search"]');
searchInput.addEventListener("input", (e) => {
  searchProduct(searchInput.value);
});
