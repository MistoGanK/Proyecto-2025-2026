/**
 * productDetails.js - Gestión de producto y Mini-Cart (Dropdown)
 */
document.addEventListener("DOMContentLoaded", () => {
  // --- 1. Elementos del DOM ---
  const section_product = document.querySelector(".section_product");
  const cartForm = document.querySelector('.cart_form'); // Contenedor de productos en el dropdown
  const progress_message = document.querySelector('.progress_message');
  const subtotalDisplay = document.querySelector(".cart_footer_info p");
  const checkoutBtn = document.querySelector(".cart_footer_button");
  const cartDropDown = document.querySelector('.cart_drop_down');
  const closeCartBtn = document.getElementById("cart_dropdown_button_close");
  
  const params = new URLSearchParams(window.location.search);
  const productId = params.get("id");
  const needFreeShipping = 60; // Umbral para envío gratis

  // --- 2. Validaciones Iniciales ---
  if (!productId || isNaN(productId)) {
    window.location.href = "../index.html";
    return;
  }

  // --- 3. Funciones de Carga (Fetch) ---

  // Obtener detalles del producto principal
  async function getProductData() {
    try {
      const response = await fetch(`../backend/endpoints/product_details/getProductDetails.php?id=${productId}`);
      const item = await response.json();
      if (item && !item.error) {
        renderProductDetails(item);
      }
    } catch (error) {
      console.error("Error al obtener producto:", error);
    }
  }

  // Obtener datos del carrito (para el dropdown)
  async function loadCart() {
    try {
      const response = await fetch('../backend/endpoints/carts/getCartDetails.php');
      const data = await response.json();
      
      if (data && data.items && data.items.length > 0) {
        renderCart(data.items, data.total);
      } else {
        renderEmptyCart();
      }
    } catch (error) {
      console.error("Error al cargar carrito:", error);
      renderEmptyCart();
    }
  }

  // --- 4. Funciones de Renderizado ---

  function renderProductDetails(item) {
    const imagesHTML = item.all_images
      .map(src => `
          <div class="swiper_container">
              <img src="${src}" alt="${item.product_name}" 
                   onerror="this.src='../assets/img/placeholder.png';this.onerror=null;">
          </div>
      `).join("");

    section_product.innerHTML = `
    <div class="product_wrap">
      <header class="product_header_movile">
        <div class="product_header_top">
          <p class="product_tag">Style #022-P-${item.id_product}</p>
          <div class="product_rating">
            <div class="product_rating_starts">
              ${'<img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp">'.repeat(4)}
              <img src="../assets/icons/star_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp">
            </div>
            <div class="product_number_reviews"><a href="#">864</a></div>
          </div>
        </div>
        <div class="product_header_middle">
          <h1 class="product_title">${item.product_name}</h1>
          <div class="product_description"><p>${item.description.substring(0, 100)}...</p></div>
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
          </div>
          <div class="product_header_middle"><h1 class="product_title">${item.product_name}</h1></div>
          <div class="product_price"><p>${item.price}€</p></div>
        </header>

        <form class="product_form">
          <div class="product_color">
            <p class="product_label">Color: <span class="product_label_span">Eco Black Deluxe</span></p>
            <ul class="product_color_list">
               <li class="product_color_item"><button type="button" class="buttom_color_item"><img src="../assets/img/products/colors/eco_black_deluxe.webp"></button></li>
            </ul>
          </div>
          <div class="product_options">
            <button type="button" id="button_product_buy">Buy</button>
            <button type="button" id="button_product_cart">Add to Cart</button>
          </div>
        </form>

        <div class="products_toggles">
          <div class="product_toggle">
            <button class="product_toggle_button"><h2>Description</h2><p>+</p></button>
            <div class="toggle_message" style="display:none;"><p>${item.description}</p></div>
          </div>
        </div>
      </div>
    </div>`;

    // Evento Añadir al Carrito
    const btnCart = document.getElementById("button_product_cart");
    if (btnCart) {
      btnCart.addEventListener("click", async () => {
        const formData = new FormData();
        formData.append("id_product", item.id_product);
        formData.append("qty", 1);

        const response = await fetch("../backend/endpoints/carts/addToCart.php", { method: "POST", body: formData });
        const result = await response.json();
        
        if (result.success) {
          await loadCart(); // Recargar el mini-cart
          cartDropDown.classList.remove('hidden'); // Abrirlo automáticamente para feedback visual
          cartDropDown.style.display = 'flex'; // Asegurar visibilidad si usas display en lugar de hidden
        }
      });
    }

    setupToggles();
  }

  function renderCart(items, total) {
    if (!cartForm) return;
    cartForm.innerHTML = items.map(item => `
        <article class="cart_item" data-id="${item.id_product}">
            <div class="item_main">
                <div class="item_img">
                    <img src="${item.img_src}" alt="${item.product_name}">
                </div>
                <div class="item_details">
                    <h2>${item.product_name}</h2>
                    <p>Price: ${item.price}€</p>
                </div>
            </div>
            <div class="item_footer">
                <button type="button" class="btn_delete underline text-xs font-bold" data-id="${item.id_product}">Delete</button>
                <div class="item_action_buttons flex w-fit border border-solid border-[rgba(10,9,12,0.345)] rounded-[5px] items-center">
                    <button type="button" class="btn_substract px-2" data-id="${item.id_product}">-</button>
                    <p class="item_qty px-3 text-sm">${item.qty}</p>
                    <button type="button" class="item_agregation px-2" data-id="${item.id_product}">+</button>
                </div>
            </div>
        </article>
    `).join('');

    updateUI(items.length, total);
    setupCartEventListeners(); 
  }

  function renderEmptyCart() {
    if (cartForm) cartForm.innerHTML = `<p class="p-8 text-center text-gray-500">Your cart is empty.</p>`;
    updateUI(0, 0);
  }

  // --- 5. Lógica de UI y Acciones del Carrito ---

  function updateUI(count, total) {
    const totalNum = parseFloat(total);
    const formattedTotal = totalNum.toFixed(2);
    
    if (subtotalDisplay) subtotalDisplay.textContent = `${formattedTotal}€`;
    if (checkoutBtn) checkoutBtn.textContent = `Checkout (${count})`;
    
    // Barra de progreso y mensaje
    if (progress_message) {
      progress_message.innerHTML = totalNum >= needFreeShipping 
        ? "Your cart qualifies for free shipping" 
        : `You are ${(needFreeShipping - totalNum).toFixed(2)}€ away from free shipping`;
    }
    
    const progressBar = document.querySelector('.free_shipping_progress');
    if (progressBar) {
      const percentage = Math.min((totalNum / needFreeShipping) * 100, 100);
      progressBar.style.width = `${percentage}%`;
    }
  }

  function setupCartEventListeners() {
    document.querySelectorAll('.btn_delete').forEach(btn => {
      btn.onclick = () => updateCartAction(btn.dataset.id, 'remove');
    });
    document.querySelectorAll('.item_agregation').forEach(btn => {
      btn.onclick = () => updateCartAction(btn.dataset.id, 'add', 1);
    });
    document.querySelectorAll('.btn_substract').forEach(btn => {
      btn.onclick = () => {
        const qty = parseInt(btn.parentElement.querySelector('.item_qty').textContent);
        if (qty > 1) updateCartAction(btn.dataset.id, 'add', -1);
      };
    });
  }

  async function updateCartAction(id, action, qty = 1) {
    const endpoint = action === 'remove' ? 'removeFromCart.php' : 'addToCart.php';
    const formData = new FormData();
    formData.append('id_product', id);
    if(action !== 'remove') formData.append('qty', qty);

    try {
      await fetch(`../backend/endpoints/carts/${endpoint}`, { method: 'POST', body: formData });
      loadCart();
    } catch (e) { console.error("Error updating cart", e); }
  }

  // --- 6. Toggles y Eventos de Cierre ---
  function setupToggles() {
    document.querySelectorAll(".product_toggle_button").forEach(btn => {
      btn.onclick = () => {
        const msg = btn.nextElementSibling;
        msg.style.display = msg.style.display === "none" ? "block" : "none";
      };
    });
  }

  if (closeCartBtn) {
    closeCartBtn.onclick = () => {
        cartDropDown.classList.add('hidden');
        cartDropDown.style.display = 'none';
    };
  }

  // Inicio
  getProductData();
  loadCart();
});