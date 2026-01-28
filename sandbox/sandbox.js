// Persoanl endpoint
const personalEndPoint = "/student022/sandbox/sandboxEndPoint.php";

// HTML ELEMENTS
const pResponse = document.getElementById('response');

console.log(pResponse);
let apiResult = {};
// accuweather current location

// API JSON GET

// accuweather endpoint conditions of the location
const devKey = "zpka_12b7197a19df4f349e86a877dec3359c_d7027ca7";
const locationKey = "34227";
const options = {
    method: "GET",
    headers: {
    Authorization: `Bearer ${devKey}`,
    },
};

// Fetch sabe the API result
async function fetchApi() {
    fetch(
    "https://dataservice.accuweather.com/locations/v1/cities/search?q=maó",
    options
    )
    .then((response) => response.json())
    .then((response) => {
        sendApiResponse(response);
    })
    .catch((err) => console.error(err));
}

// Sending API response to ENDPOINT
async function sendApiResponse(apiResult) {
    // DEBUG
    console.log(apiResult);
    fetch(`${personalEndPoint}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
    },
        body: JSON.stringify({apiResult : apiResult}),
    })
    .then()
    .then((data) => console.log(data))
}   

fetchApi();
