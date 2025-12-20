window.addEventListener("DOMContentLoaded", () => {
  // Elements and Parametres
  const section_product = document.querySelector(".section_product");
  const params = new URLSearchParams(window.location.search);
  const productId = params.get("id");
  const productDetailEndpointUrl = `../backend/endpoints/product_details/getProductDetails.php?id=${productId}`;

  // Initial Validation
  if (!productId || isNaN(productId)) {
    window.location.href = "../index.html";
    return;
  }

  // Function for fetch
  async function getJsonElement(endPointUrl) {
    try {
      const response = await fetch(endPointUrl);
      const item = await response.json();
      if (item && !item.error) {
        renderProductDetails(item);
      }
    } catch (error) {
      console.error("Error al obtener datos del producto:", error);
    }
  }

  // Function Render
  function renderProductDetails(item) {
    // Imgs
    const imagesHTML = item.all_images
      .map(
        (src) => `
            <div class="swiper_container">
                <img src="${src}" alt="${item.product_name}" 
                     onerror="this.src='../assets/img/placeholder.png';this.onerror=null;">
            </div>
        `
      )
      .join("");

    section_product.innerHTML = `
    <div class="product_wrap">
      <header class="product_header_movile">
        <div class="product_header_top">
          <p class="product_tag">Style #022-P-${item.id_product}</p>
          <div class="product_rating">
            <div class="product_rating_starts">
              <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
              <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
              <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
              <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
              <img src="../assets/icons/star_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp" alt="icon star">
            </div>
            <div class="product_number_reviews"><a href="#">864</a></div>
          </div>
        </div>
        <div class="product_header_middle">
          <h1 class="product_title">${item.product_name}</h1>
          <div class="product_description">
            <p>${item.description.substring(0, 100)}...</p>
          </div>
        </div>
        <div class="product_price"><p>${item.price}€</p></div>
      </header>
      <div class="product_media">
        <div class="product_images">
          <div class="product_images_movile" id="carousel">${imagesHTML}</div>
          <div class="products_images_no_movile">${imagesHTML}</div>
        </div>
      </div>
      <div class="product_info">
        <header class="product_header_no_movile">
          <div class="product_header_top">
            <p class="product_tag">Style #022-P-${item.id_product}</p>
            <div class="product_rating">
              <div class="product_rating_starts">
                <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
                <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
                <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
                <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="icon star">
                <img src="../assets/icons/star_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp" alt="icon star">
              </div>
              <div class="product_number_reviews"><a href="#">864</a></div>
            </div>
          </div>
          <div class="product_header_middle"><h1 class="product_title">${item.product_name}</h1></div>
          <div class="product_price"><p>${item.price}€</p></div>
        </header>
        <form class="product_form">
          <div class="product_color">
            <div class="product_label_wrapper">
              <p class="product_label">Color: <span class="product_label_span">Eco Black Deluxe</span></p>
              <p class="product_label">Stock: <span class="product_label_span">Ships in 1-3 days</span></p>
            </div>
            <ul class="product_color_list">
              <li class="product_color_item"><button type="button" class="buttom_color_item"><img src="../assets/img/products/colors/eco_black_deluxe.webp" alt="color black"></button></li>
              <li class="product_color_item"><button type="button" class="buttom_color_item"><img src="../assets/img/products/colors/eco_night_fall.webp" alt="color night"></button></li>
              <li class="product_color_item"><button type="button" class="buttom_color_item"><img src="../assets/img/products/colors/eco_static.webp" alt="color static"></button></li>
              <li class="product_color_item"><button type="button" class="buttom_color_item"><img src="../assets/img/products/colors/eco_titanium.webp" alt="color titanium"></button></li>
              <li class="buttom_favorite_item">
                <button type="button" class="button_add_to_fav">
                  <p>Add to favorite</p>
                  <img id="imgFav" src="../assets/icons/favorite_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp">
                </button>
              </li>
            </ul>
          </div>
          <div class="product_options">
            <button type="button" id="button_product_buy">Buy<img src="../assets/icons/arrow_right_alt_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp"></button>
            <button type="button" id="button_product_cart">Add to Cart<img src="../assets/icons/add_500dp_FEFFFE_FILL0_wght400_GRAD0_opsz48.webp"></button>
          </div>
        </form>
        <div class="products_perks">
          <div class="product_perks">
            <div class="product_perks_item"><div class="product_perk_icon"><img src="../assets/icons/eco.webp"></div><a class="product_perk_link" href="#">Made from Recycled Materials</a></div>
            <div class="product_perks_item"><div class="product_perk_icon"><img src="../assets/icons/shipping.webp"></div><a class="product_perk_link" href="#">Fast Shipping</a></div>
            <div class="product_perks_item"><div class="product_perk_icon"><img src="../assets/icons/warranty.webp"></div><a class="product_perk_link" href="#">Warranty Included</a></div>
          </div>
        </div>
        <div class="products_toggles">
          <div class="product_toggle">
            <button class="product_toggle_button"><h2>Description</h2><p>+</p></button>
            <div class="toggle_message" style="display:none;"><p>${item.description}</p></div>
          </div>
          <div class="product_toggle">
            <button class="product_toggle_button"><h2>Features</h2><p>+</p></button>
            <div class="toggle_message" style="display:none;">
              <ul class="toggle_message_list">
                <li>Luggage pass-through for attaching to your wheelie companion</li>
                <li>Reflective tape under compression straps</li>
                <li>Padded strap and back panel for extra comfort</li>
                <li>Airmesh ventilated back panel</li>
                <li>100% recycled nylon from pre-consumer materials</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>`;

    // AHORA QUE EL HTML ESTÁ EN LA PÁGINA, BUSCAMOS LOS BOTONES PARA EVENTOS
    const btnCart = document.getElementById("button_product_cart");
    if (btnCart) {
      btnCart.addEventListener("click", async () => {
        const formData = new FormData();
        formData.append("id_product", item.id_product);
        formData.append("qty", 1);

        try {
          const response = await fetch("../backend/endpoints/carts/addToCart.php", {
            method: "POST",
            body: formData,
          });
          const result = await response.json();
          if (result.success) {
            alert("Producto añadido al carrito");
          }
        } catch (error) {
          console.error("Error al añadir al carrito:", error);
        }
      });
    }

    // Prevent Default submit
    const product_form = section_product.querySelector(".product_form");
    if (product_form) {
      product_form.addEventListener("submit", (e) => e.preventDefault());
    }

    // Actualizar breadcrumb
    const crum = document.getElementById("crum_product");
    if (crum) crum.textContent = item.product_name;

    // Toggles
    setupToggles();
  }

  // Function Toggles
  function setupToggles() {
    const buttons = document.querySelectorAll(".product_toggle_button");
    buttons.forEach((btn) => {
      btn.addEventListener("click", () => {
        const message = btn.nextElementSibling;
        const icon = btn.querySelector("p");
        const isHidden = message.style.display === "none" || message.style.display === "";
        message.style.display = isHidden ? "block" : "none";
        if (icon) icon.textContent = isHidden ? "-" : "+";
      });
    });
  }

  // 5. Inicio del proceso
  getJsonElement(productDetailEndpointUrl);
});