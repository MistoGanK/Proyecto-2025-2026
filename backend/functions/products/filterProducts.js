const endPointProductFilter =
  "/student022/backend/endpoints/products/productFilter.php";

function filterProducts(inputDateIn,inputDateOut,inputSelect) {
  var http = new XMLHttpRequest();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      jsonEndpoint = this.response;
      document.getElementById("products_container").innerHTML = jsonEndpoint;
    }
  };

  http.open(
    "GET",
    endPointProductFilter +
      "?filterDateIn=" +
      encodeURIComponent(inputDateIn) +
      "&filterDateOut=" +
      encodeURIComponent(inputDateOut) +
      "&inputSelect=" +
      encodeURIComponent(inputSelect),
    true,
  );
  http.send();
}
let productsDiv = document.getElementById("searchEndPointResult");
// Event listener
let formFilter = document.querySelector("#formFilter");
formFilter.addEventListener("submit", (e) => {
  e.preventDefault();

  const filterDateIn = document.querySelector("#filterDateIn");
  const filterDateOut = document.querySelector("#filterDateOut");
  const filterOrder = document.querySelector("#filterOrder");

  filterProducts(filterDateIn.value,filterDateOut.value,filterOrder.value);
});
