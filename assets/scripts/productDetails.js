window.addEventListener("DOMContentLoaded", () => {
    // 1. Elementos del DOM y Configuración
    const section_product = document.querySelector(".section_product");
    const params = new URLSearchParams(window.location.search);
    const productId = params.get('id');
    const productDetailEndpointUrl = `../backend/endpoints/product_details/getProductDetails.php?id=${productId}`;

    // 2. Validación inicial
    if (!productId || isNaN(productId)) {
        console.warn("ID de producto no válido o ausente.");
        window.location.href = "../index.html";
        return;
    }

    /**
     * Obtiene el JSON del servidor y ejecuta el render
     */
    async function getJsonElement(endPointUrl, renderFnc) {
        try {
            const response = await fetch(endPointUrl);
            const text = await response.text();
            try {
                const data = JSON.parse(text);
                renderFnc(data);
            } catch (parseError) {
                console.error("Error al parsear JSON. El servidor respondió:", text);
            }
        } catch (error) {
            console.error("Error de red al conectar con el endpoint:", error);
        }
    }

    /**
     * Inyecta el HTML dinámico en la página
     */
    function renderProductDetails(item) {
        if (!item || item.error) {
            section_product.innerHTML = `<p class="error_message">Producto no encontrado.</p>`;
            return;
        }

        // Generamos el bloque de imágenes una sola vez para reutilizarlo
        const imagesHTML = item.all_images.map(src => `
            <div class="swiper_container">
                <img src="${src}" alt="${item.product_name}" 
                     onerror="this.src='../assets/img/placeholder.png';this.onerror=null;">
            </div>
        `).join('');

        // Inyectamos la estructura completa
        section_product.innerHTML = `
        <div class="product_wrap">
            <header class="product_header_movile">
                <div class="product_header_top">
                    <p class="product_tag">Style #022-P-${item.id_product}</p>
                    <div class="product_rating">
                        <div class="product_rating_starts">
                            <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="star">
                            <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="star">
                            <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="star">
                            <img src="../assets/icons/star_500dp_0A090C_FILL1_wght400_GRAD0_opsz48.webp" alt="star">
                            <img src="../assets/icons/star_500dp_0A090C_FILL0_wght400_GRAD0_opsz48.webp" alt="star">
                        </div>
                        <div class="product_number_reviews"><a href="#">864</a></div>
                    </div>
                </div>
                <div class="product_header_middle">
                    <h1 class="product_title">${item.product_name}</h1>
                    <div class="product_description">
                        <p>${item.description.substring(0, 80)}...</p>
                    </div>
                </div>
                <div class="product_price"><p>${item.price}€</p></div>
            </header>

            <div class="product_media">
                <div class="product_images">
                    <div class="product_images_movile" id="carousel">
                        ${imagesHTML}
                    </div>
                    <div class="products_images_no_movile">
                        ${imagesHTML}
                    </div>
                </div>
            </div>

            <div class="product_info">
                <header class="product_header_no_movile">
                    <div class="product_header_top">
                        <p class="product_tag">Style #022-P-${item.id_product}</p>
                    </div>
                    <div class="product_header_middle">
                        <h1 class="product_title">${item.product_name}</h1>
                    </div>
                    <div class="product_price"><p>${item.price}€</p></div>
                </header>

                <form class="product_form">
                    <div class="product_color">
                        <div class="product_label_wrapper">
                            <p class="product_label">Status: <span class="product_label_span">${item.availability}</span></p>
                            <p class="product_label">Stock: <span class="product_label_span">${item.stock} units</span></p>
                        </div>
                    </div>
                    <div class="product_options">
                        <button type="button" id="button_product_buy">Buy</button>
                        <button type="button" id="button_product_cart">Add to Cart</button>
                    </div>
                </form>

                <div class="products_toggles">
                    <div class="product_toggle">
                        <button class="product_toggle_button">
                            <h2>Description</h2>
                            <p class="toggle_icon">+</p>
                        </button>
                        <div class="toggle_message" style="display:none;">
                            <p>${item.description}</p>
                        </div>
                    </div>
                    <div class="product_toggle">
                        <button class="product_toggle_button">
                            <h2>Features</h2>
                            <p class="toggle_icon">+</p>
                        </button>
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

        // Actualizar Breadcrumb
        const crum = document.getElementById("crum_product");
        if(crum) crum.textContent = item.product_name;

        // Activar interactividad
        setupToggles();
    }

    /**
     * Configura el comportamiento de abrir/cerrar de los toggles
     */
    function setupToggles() {
        const toggleButtons = document.querySelectorAll(".product_toggle_button");
        toggleButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                const message = btn.nextElementSibling;
                const icon = btn.querySelector(".toggle_icon");
                
                if (message.style.display === "none" || message.style.display === "") {
                    message.style.display = "block";
                    icon.textContent = "-";
                } else {
                    message.style.display = "none";
                    icon.textContent = "+";
                }
            });
        });
    }

    // 3. Lanzar la petición
    getJsonElement(productDetailEndpointUrl, renderProductDetails);
});