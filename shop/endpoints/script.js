const product_name = document.getElementById("product_name");
console.log(product_name);
const suggestion = document.getElementById("suggestion");
console.log(suggestion);

function showHint(str) {
  if (str.length == 0) {
    suggestion.innerHTML = "";
    return;
  } else {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      suggestion.innerHTML = this.responseText;
    };
    xhttp.open("GET", "gethint.php?q=" + str, true);
    xhttp.send();
  }
}
