window.addEventListener("DOMContentLoaded", (e) => {
  // HTML elements
  // about_container
  const articles_about_container = document.querySelector(
    ".articles_about_container"
  );
  // Hot sellers container
  const hot_sellers_container = document.querySelector(
    ".hot_sellers_container"
  );
  // New product container
  const new_product_section = document.querySelector(".new_product_section");
  // Travel section (Rotation)
  const travel_section = document.querySelector(".travel_section");
  // Hero product section
  const hero_section = document.querySelector(".hero_section");

  // URL
  // About endpoint
  const aboutEndpointUrl =
    "/student022/backend/endpoints/about_us/getAboutUs.php";
  // Hot sellers
  const hotSellersEndpointUrl =
    "/student022/backend/endpoints/hot_sellers/getHotsellers.php";
  // New Product
  const newFeaturedItemEndpointUrl =
    "/student022/backend/endpoints/new_feature_item/getNewFeaturedItem.php";
  // Rotative
  const rotativeFeaturedEndPointUrl =
    "/student022/backend/endpoints/rotative/getRotationProducts.php";
  // Hero
  const heroProductEndPointUrl =
    "/student022/backend/endpoints/heroProduct/getHeroProduct.php";

  // Functions
  // API endpoint About Section
  /**
   * Gets the data from the endpoint from the backend and processes it on Async mode.
   * Render the fetched data with specified render fnc
   * * @param {string} getJsonElement - The URL of the PHP file that serves the JSON.
   */
  async function getJsonElement(endPointUrl, renderFnc) {
    try {
      const response = await fetch(endPointUrl);

      // TRUCO: Antes de procesar el JSON, verificamos si es texto plano (error)
      const text = await response.text();

      try {
        const data = JSON.parse(text); // Intentamos convertirlo a objeto
        renderFnc(data);
      } catch (parseError) {
        // Si falla, es porque 'text' contiene el error de PHP
        console.error("EL ERROR ESTÁ EN ESTE ENDPOINT:", endPointUrl);
        console.error("EL SERVIDOR RESPONDIÓ ESTO:", text);
      }
    } catch (error) {
      console.error("Error de red: ", error);
    }
  }
  /**
  // Render Function
  /**
   * Renders fetchedData cards in a specific container.
   * @param {Array} renderAboutSection - List of objects (id, title, image_path) fetched from the DB.
   */
  function renderAboutSection(aboutItems) {
    // Iterate html element about_container
    let i = 0; // NODE acces on JSON OBJECT
    aboutItems.forEach((item) => {
      // Json Object Variables
      let article_about_container = document.createElement("article");
      article_about_container.classList.add("about_container");
      article_about_container.innerHTML += `
      <div class="about_img_container">
            <img class="about_img" src="${item.img_src}" alt="Brand2 ${item.about_name}>
          </div>
          <header class="about_content_header">
            <h3>${item.about_name}</h3>
          </header>
    `;
      // Append to parent
      articles_about_container.appendChild(article_about_container);
      i += 1;
    });
  }
  // Hot Sellers Render
  /**
   * Renders brand cards in a specific container.
   * @param {Array} renderHotSellerSection - List of objects (id, title, image_path) fetched from the DB.
   */
  function renderHotSellerSection(hotSellersItems) {
    hotSellersItems.forEach((item) => {
      let article_hot_seller = document.createElement("article");
      article_hot_seller.classList.add("hot_seller");
      article_hot_seller.innerHTML = `
        <div class="hot_seller_content">
          <a href="views/productDetails.html?id=${item.id_product}">
            <img src="${item.img_src}" alt="${item.product_name}" class="card_background_img" />
          </a>
          
          <a href="productDetails.html?id=${item.id_product}" class="product_link_title">
            <h3>${item.product_name}</h3>
          </a>

          <div class="card_content_buttons">
            <button>
              <a>Buy ${item.price}€</a>
              <img src="assets/icons/attach_money_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp" alt="Buy Product" />
            </button>
            <button>
              <a>Add to Cart</a>
              <img src="assets/icons/add_shopping_cart_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp" alt="Add to Cart" />
            </button>
            <button class="fav_button">
              <a>Add to Favorite</a>
              <img class="fav_empty" id="icon_favorite"
                src="assets/icons/favorite_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp" alt="Add to favorite" />
            </button>
          </div>
        </div>
    `;
      hot_sellers_container.appendChild(article_hot_seller);
    });
  }

  // New Featured Item Render
  /**
   * Renders the New Featured Item cards in a specific container.
   * @param {Array} renderNewFeaturedItem - List of objects (id, title, image_path) fetched from the DB.
   */
  function renderNewFeaturedItem(newFeaturedItem) {
    newFeaturedItem.forEach((item) => {
      new_product_section.innerHTML += `
    <header class="new_product_header">
      <h2>Tech Ready</h2>
      <p>Smart storage and padded protection for workday essentials.</p>
    </header>
    <div class="new_product_content">
      <div class="new_button_container">
        <button class="new_button" onclick="window.location.href='views/productDetails.html?id=${item.id_product}'">
          <p>See Detaills</p>
        </button>
        </div>
    </div>`;
    });
  }
  // New Featured Item Render
  /**
   * Renders Rotative Item cards in a specific container.
   * @param {Array} renderRotationItem - List of objects (id, title, image_path) fetched from the DB.
   */
  function renderRotationItem(rotationItems) {
    // Div card_container
    rotationItems.forEach((item) => {
      div_card_container = document.createElement("div");
      div_card_container.classList.add("card_container");
      div_card_container.innerHTML = `
        <img src="${item.img_src}" alt="Imagen de fondo del artículo"
          class="card_background_img" />
        <a href="views/productDetails.html?id=${item.id_product}">
        <div class="card_content">
          <h3>${item.product_name}</h3>
          <div class="card_content_buttons">
            <button>
              <a>Buy ${item.price}€</a>
              <img src="assets/icons/attach_money_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp" alt="Buy Product" />
            </button>
            <button>
              <a>Add to Cart</a>
              <img src="assets/icons/add_shopping_cart_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp"
                alt="Add to Cart" />
            </button>
            <button class="fav_button">
              <a>Add to Favorite</a>
              <img class="fav_empty" id="icon_favorite"
                src="assets/icons/favorite_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp" alt="Add to favorite" />
            </button>
          </div>
        </div>
        </a>
    `;
      travel_section.appendChild(div_card_container);
    });
  }

  // Hero
  /**
   * Renders Hero Item in a specific container.
   * @param {Array} renderHeroSection - List of objects (id, title, image_path) fetched from the DB.
   */
  function renderHeroSection(heroItem) {
    // Div card_container
    heroItem.forEach((item) => {
      console.log(item);
      let hero_section_content = document.createElement("article");
      hero_section_content.classList.add("hero_section_content");
      hero_section_content.innerHTML = ` 
        <a href="views/productDetails.html?id=${item.id_product}">
          <button>Shop</button>
        </a>
    `;
      hero_section.appendChild(hero_section_content);
    });
  }

  // Render
  getJsonElement(aboutEndpointUrl, renderAboutSection);
  getJsonElement(hotSellersEndpointUrl, renderHotSellerSection);
  getJsonElement(newFeaturedItemEndpointUrl, renderNewFeaturedItem);
  getJsonElement(rotativeFeaturedEndPointUrl, renderRotationItem);
  getJsonElement(heroProductEndPointUrl, renderHeroSection);
});
