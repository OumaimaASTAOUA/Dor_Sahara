document.addEventListener("DOMContentLoaded", () => {
  let cart = [];
  let currentRestaurantId = null;

  let comments = [
    { user: "Ahmed", text: "Excellente nourriture, livraison rapide !" },
    { user: "Sara", text: "Les plats sont authentiques et délicieux." },
  ];

  const menuPopup = document.getElementById("menuPopup");
  const popupRestaurantName = document.getElementById("popupRestaurantName");
  const popupRestaurantCategory = document.getElementById("popupRestaurantCategory");
  const popupMenuItems = document.getElementById("popupMenuItems");
  const cartItemsContainer = document.getElementById("cartItems");
  const cartTotalContainer = document.getElementById("cartTotal");
  const closePopupBtn = document.querySelector(".menu-popup__close");
  const cartSidebar = document.getElementById("cartSidebar");
  const cartSidebarItems = document.getElementById("cartSidebarItems");
  const cartSidebarTotal = document.getElementById("cartSidebarTotal");
  const cartSidebarClose = document.querySelector(".cart-sidebar__close");
  const cartButton = document.querySelector(".nav__btn .btn");
  const cartBadge = document.getElementById("cartBadge");
  const notification = document.getElementById("notification");
  const commentInput = document.getElementById("commentInput");
  const submitComment = document.getElementById("submitComment");
  const commentsList = document.getElementById("commentsList");

  // Check if all required elements exist
  if (
    !menuPopup ||
    !popupRestaurantName ||
    !popupRestaurantCategory ||
    !popupMenuItems ||
    !cartItemsContainer ||
    !cartTotalContainer ||
    !cartSidebar ||
    !cartSidebarItems ||
    !cartSidebarTotal ||
    !cartButton ||
    !cartBadge ||
    !commentInput ||
    !submitComment ||
    !commentsList
  ) {
    console.error("One or more required elements are missing");
    return;
  }

  // Update cart summary for both popup and sidebar
  function updateCartSummary() {
    cartItemsContainer.innerHTML = "";
    cartSidebarItems.innerHTML = "";
    let total = 0;
    let totalItems = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = "<p>Votre panier est vide.</p>";
      cartSidebarItems.innerHTML = "<p>Votre panier est vide.</p>";
    } else {
      cart.forEach((item, index) => {
        // Popup cart
        const cartItem = document.createElement("div");
        cartItem.className = "cart-item";
        cartItem.innerHTML = `
          <span>${item.name} <span class="restaurant-name">(${item.restaurant})</span></span>
          <div class="quantity-controls">
            <button class="decrease-quantity" data-index="${index}">-</button>
            <span>${item.quantity}</span>
            <button class="increase-quantity" data-index="${index}">+</button>
          </div>
          <span class="quantity">${(item.price * item.quantity).toFixed(2)} MAD</span>
          <button class="remove-item" data-index="${index}">Supprimer</button>
        `;
        cartItemsContainer.appendChild(cartItem);

        // Sidebar cart
        const sidebarItem = document.createElement("div");
        sidebarItem.className = "cart-sidebar__item";
        sidebarItem.innerHTML = `
          <span>${item.name} <span class="restaurant-name">(${item.restaurant})</span></span>
          <div class="quantity-controls">
            <button class="decrease-quantity" data-index="${index}">-</button>
            <span>${item.quantity}</span>
            <button class="increase-quantity" data-index="${index}">+</button>
          </div>
          <span class="quantity">${(item.price * item.quantity).toFixed(2)} MAD</span>
          <button class="remove-item" data-index="${index}">Supprimer</button>
        `;
        cartSidebarItems.appendChild(sidebarItem);

        total += item.price * item.quantity;
        totalItems += item.quantity;
      });
    }

    // Update total and badge
    cartTotalContainer.textContent = `Total: ${total.toFixed(2)} MAD`;
    cartSidebarTotal.textContent = `Total: ${total.toFixed(2)} MAD`;
    cartBadge.textContent = totalItems;

    // Attach event listeners for cart actions
    attachCartEventListeners();
  }

  // Show notification
  function showNotification(message) {
    notification.textContent = message;
    notification.classList.add("show");
    setTimeout(() => {
      notification.classList.remove("show");
    }, 3000);
  }

  // Update comments list
  function updateCommentsList() {
    commentsList.innerHTML = "";
    comments.forEach((comment) => {
      const commentElement = document.createElement("div");
      commentElement.className = "comment";
      commentElement.innerHTML = `
        <p class="user">${comment.user}</p>
        <p>${comment.text}</p>
      `;
      commentsList.appendChild(commentElement);
    });
  }

  // Attach cart event listeners
  function attachCartEventListeners() {
    // Remove item
    document.querySelectorAll(".remove-item").forEach((btn) => {
      btn.addEventListener("click", () => {
        const index = parseInt(btn.getAttribute("data-index"));
        cart.splice(index, 1);
        updateCartSummary();
        showNotification("Article supprimé du panier !");
      });
    });

    // Increase quantity
    document.querySelectorAll(".increase-quantity").forEach((btn) => {
      btn.addEventListener("click", () => {
        const index = parseInt(btn.getAttribute("data-index"));
        cart[index].quantity += 1;
        updateCartSummary();
        showNotification("Quantité augmentée !");
      });
    });

    // Decrease quantity
    document.querySelectorAll(".decrease-quantity").forEach((btn) => {
      btn.addEventListener("click", () => {
        const index = parseInt(btn.getAttribute("data-index"));
        if (cart[index].quantity > 1) {
          cart[index].quantity -= 1;
          updateCartSummary();
          showNotification("Quantité diminuée !");
        } else {
          cart.splice(index, 1);
          updateCartSummary();
          showNotification("Article supprimé du panier !");
        }
      });
    });

    // Place order (mock)
    document.querySelectorAll(".place-order, .cart-sidebar__checkout").forEach((btn) => {
      btn.addEventListener("click", () => {
        if (cart.length === 0) {
          showNotification("Votre panier est vide !");
        } else {
          showNotification("Commande passée avec succès !");
          cart = [];
          updateCartSummary();
        }
      });
    });
  }

  // Initialize details buttons
  const detailButtons = document.querySelectorAll(".details__btn");
  if (detailButtons.length === 0) {
    console.warn("No detail buttons found in the DOM");
  }

  detailButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      console.log("Details button clicked, ID:", button.getAttribute("data-id"));

      const restaurantCard = button.closest(".restaurant__card");
      if (!restaurantCard) {
        console.error("Restaurant card not found for button:", button);
        showNotification("Erreur : Restaurant non trouvé.");
        return;
      }

      const restaurantId = button.getAttribute("data-id");
      const restaurantName = restaurantCard.getAttribute("data-restaurant") || "Unknown Restaurant";
      const restaurantCategory = restaurantCard.getAttribute("data-category") || "";
      let menuData = restaurantCard.getAttribute("data-menus");

      // Update current restaurant ID
      currentRestaurantId = restaurantId;

      // Clear cart if switching to a different restaurant
      if (cart.length > 0 && cart[0].restaurant !== restaurantName) {
        cart = [];
        showNotification("Panier vidé car vous avez sélectionné un autre restaurant.");
      }

      // Set popup content
      popupRestaurantName.textContent = restaurantName;
      popupRestaurantCategory.textContent = restaurantCategory
        ? restaurantCategory.charAt(0).toUpperCase() + restaurantCategory.slice(1)
        : "Unknown Category";

      // Parse menu items
      let menuItems = [];
      if (menuData) {
        try {
          // Replace single quotes with double quotes for valid JSON
          menuData = menuData.replace(/'/g, '"');
          menuItems = JSON.parse(menuData);
          console.log("Parsed menu items:", menuItems);
        } catch (e) {
          console.error("Error parsing menu data:", e, "Raw data:", menuData);
          menuItems = [];
          showNotification("Erreur : Impossible de charger le menu.");
        }
      } else {
        console.warn("No menu data found for restaurant ID:", restaurantId);
        showNotification("Aucun menu disponible pour ce restaurant.");
      }

      // Populate menu items
      popupMenuItems.innerHTML = "";
      if (!menuItems || menuItems.length === 0) {
        popupMenuItems.innerHTML = "<p>Aucun menu disponible pour ce restaurant.</p>";
      } else {
        menuItems.forEach((item) => {
          const name = item.name ? String(item.name).replace(/[<>"'&]/g, "") : "Unnamed Item";
          const description = item.description
            ? String(item.description).replace(/[<>"'&]/g, "")
            : "Pas de description disponible.";
          const price = item.price ? parseFloat(item.price) : 0;
          const image = item.image ? String(item.image).replace(/[<>"'&]/g, "") : null;
          const imageSrc = image ? `/storage/menus/${image}` : "/images/default-menu.jpg";

          const itemElement = document.createElement("div");
          itemElement.className = "menu-item";
          itemElement.innerHTML = `
            <img src="${imageSrc}" alt="${name}" loading="lazy">
            <h4>${name}</h4>
            <p>${description}</p>
            <div class="price">${price.toFixed(2)} MAD</div>
            <button class="add-to-cart" data-name="${name}" data-price="${price}" data-restaurant="${restaurantName}">
              <i class="ri-shopping-cart-line"></i> Ajouter au Panier
            </button>
          `;
          popupMenuItems.appendChild(itemElement);
        });
      }

      // Add to cart functionality
      popupMenuItems.querySelectorAll(".add-to-cart").forEach((btn) => {
        btn.addEventListener("click", () => {
          const name = btn.getAttribute("data-name");
          const price = parseFloat(btn.getAttribute("data-price"));
          const restaurant = btn.getAttribute("data-restaurant");

          // Prevent adding items from different restaurants
          if (cart.length > 0 && cart[0].restaurant !== restaurant) {
            showNotification("Vous ne pouvez ajouter des articles que d'un seul restaurant à la fois.");
            return;
          }

          const existingItem = cart.find((i) => i.name === name && i.restaurant === restaurant);
          if (existingItem) {
            existingItem.quantity += 1;
          } else {
            cart.push({ name, price, restaurant, quantity: 1 });
          }

          updateCartSummary();
          showNotification("Article ajouté au panier !");
        });
      });

      menuPopup.classList.add("active");
      document.body.style.overflow = "hidden";

      updateCommentsList();
    });
  });

  submitComment.addEventListener("click", () => {
    const commentText = commentInput.value.trim();
    if (commentText) {
      comments.push({ user: "Utilisateur", text: commentText });
      commentInput.value = "";
      updateCommentsList();
      showNotification("Commentaire ajouté !");
    } else {
      showNotification("Veuillez entrer un commentaire !");
    }
  });

  cartButton.addEventListener("click", () => {
    cartSidebar.classList.add("open");
    document.body.style.overflow = "hidden";
  });

  cartSidebarClose.addEventListener("click", () => {
    cartSidebar.classList.remove("open");
    document.body.style.overflow = "auto";
  });

  cartSidebar.addEventListener("click", (e) => {
    if (e.target === cartSidebar) {
      cartSidebar.classList.remove("open");
      document.body.style.overflow = "auto";
    }
  });

  closePopupBtn.addEventListener("click", () => {
    menuPopup.classList.remove("active");
    document.body.style.overflow = "auto";
  });

  menuPopup.addEventListener("click", (e) => {
    if (e.target === menuPopup) {
      menuPopup.classList.remove("active");
      document.body.style.overflow = "auto";
    }
  });

  updateCartSummary();
});
const filterButtons = document.querySelectorAll(".filter__btn");
const restaurantCards = document.querySelectorAll(".restaurant__card");

filterButtons.forEach((button) => {
  button.addEventListener("click", () => {
    filterButtons.forEach((btn) => btn.classList.remove("active"));
    button.classList.add("active");

    const filterValue = button.getAttribute("data-filter");

    restaurantCards.forEach((card) => {
      const category = card.getAttribute("data-category");

      if (filterValue === "all" || category === filterValue) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});
