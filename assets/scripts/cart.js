/**
 * cart.js - Dynamic shopping cart management
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. DOM Elements Selection
    const cartForm = document.querySelector('.cart_form');
    const totalDisplay = document.querySelector(".main_header_info_total p");
    const subtotalDisplay = document.querySelector(".cart_footer_info p");
    const checkoutBtn = document.querySelector(".cart_footer_button");
    const btn_continue_shopping = document.querySelector("#btn_continue_shopping");

    /**
     * Loads cart data from the server (getCartDetails.php)
     */
    async function loadCart() {
        try {
            const response = await fetch('../backend/endpoints/carts/getCartDetails.php');
            
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            
            const data = await response.json();
            
            if (data && data.items && data.items.length > 0) {
                renderCart(data.items, data.total);
            } else {
                renderEmptyCart();
            }
        } catch (error) {
            console.error("Error loading cart:", error);
            renderEmptyCart();
        }
    }

    /**
     * Renders products dynamically into the HTML
     */
    function renderCart(items, total) {
        if (!cartForm) return;

        cartForm.innerHTML = items.map(item => `
            <article class="cart_item" data-id="${item.id_product}">
              <div class="item_main">
                <div class="item_img">
                  <button type="button" class="item_button">
                    <img src="${item.img_src}" alt="${item.product_name}" 
                         onerror="this.src='../assets/img/placeholder.png';">
                  </button>
                </div>
                <div class="item_details">
                  <h2>${item.product_name}</h2>
                  <p><span class="item_column">Price:</span> ${item.price}€</p>
                </div>
              </div>
              <div class="item_footer">
                <div class="delete_container">
                  <button type="button" class="btn_delete" data-id="${item.id_product}">Delete</button>
                </div>
                <div class="item_action_buttons">
                  <button type="button" class="btn_substract" data-id="${item.id_product}">-</button>
                  <p class="item_qty">${item.qty}</p>
                  <button type="button" class="item_agregation" data-id="${item.id_product}">+</button>
                </div>
              </div>
            </article>
        `).join('');

        updateUI(items.length, total);
        setupEventListeners();
    }

    /**
     * Updates prices and item counters in the UI
     */
    function updateUI(count, total) {
        const formattedTotal = parseFloat(total).toFixed(2);
        if (totalDisplay) totalDisplay.textContent = `Cart Total ${formattedTotal}€`;
        if (subtotalDisplay) subtotalDisplay.textContent = `${formattedTotal}€`;
        if (checkoutBtn) checkoutBtn.textContent = `Checkout (${count})`;
    }

    /**
     * Visual state when the cart has no items
     */
    function renderEmptyCart() {
        if (cartForm) {
            cartForm.innerHTML = `<p class="empty_message" style="text-align:center; padding:2em;">Your cart is empty.</p>`;
        }
        updateUI(0, 0);
    }

    /**
     * Assigns event listeners to dynamic buttons
     */
    function setupEventListeners() {
        // 1. Delete Button - Only way to remove items
        document.querySelectorAll('.btn_delete').forEach(btn => {
            btn.onclick = () => removeFromCart(btn.dataset.id);
        });

        // 2. Add Button (+)
        document.querySelectorAll('.item_agregation').forEach(btn => {
            btn.onclick = () => updateQuantity(btn.dataset.id, 1);
        });

        // 3. Subtract Button (-) - Stops at 1, no deletion allowed here
        document.querySelectorAll('.btn_substract').forEach(btn => {
            btn.onclick = () => {
                const currentQtyElement = btn.parentElement.querySelector('.item_qty');
                const currentQty = parseInt(currentQtyElement.textContent);

                if (currentQty > 1) {
                    updateQuantity(btn.dataset.id, -1);
                }
            };
        });
    }

    /**
     * Sends quantity updates to the server
     */
    async function updateQuantity(id_product, change) {
        const formData = new FormData();
        formData.append('id_product', id_product);
        formData.append('qty', change);

        try {
            const response = await fetch('../backend/endpoints/carts/addToCart.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                loadCart(); 
            }
        } catch (error) {
            console.error("Error updating quantity:", error);
        }
    }

    /**
     * Removes the product completely from database or cookies
     */
    async function removeFromCart(id_product) {
        const formData = new FormData();
        formData.append('id_product', id_product);

        try {
            const response = await fetch('../backend/endpoints/carts/removeFromCart.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                loadCart(); 
            }
        } catch (error) {
            console.error("Error removing item:", error);
        }
    }

    if (cartForm) {
        cartForm.addEventListener('submit', (e) => e.preventDefault());
    }

    loadCart();
    // Events
    btn_continue_shopping.addEventListener('click',(e)=>{window.location = '/student022/index.html'} )
});