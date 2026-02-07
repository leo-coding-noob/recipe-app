// Search Functionality
const searchInput = document.getElementById("searchInput");
const recipeList = document.getElementById("recipeList").getElementsByTagName("li");

// Favorites storage in browser
let favorites = JSON.parse(localStorage.getItem("favorites") || "[]");

// Render favorites from localStorage
const favoritesList = document.getElementById("favoritesList");
function renderFavorites() {
    favoritesList.innerHTML = "";
    
    if (favorites.length === 0) {
        const emptyMsg = document.createElement("div");
        emptyMsg.className = "empty-message";
        emptyMsg.textContent = "No favorites yet. Add recipes to favorites!";
        favoritesList.appendChild(emptyMsg);
        return;
    }
    
    favorites.forEach(recipe => {
        // Create card div
        const card = document.createElement("div");
        card.className = "favorite-card";
        
        // Create title link
        const titleLink = document.createElement("a");
        titleLink.className = "favorite-title";
        titleLink.href = `view.php?id=${recipe.id}`;
        titleLink.textContent = recipe.title;
        
        // Create remove button
        const removeBtn = document.createElement("button");
        removeBtn.className = "remove-btn";
        removeBtn.textContent = "Remove";
        removeBtn.addEventListener("click", () => {
            favorites = favorites.filter(fav => fav.id !== recipe.id);
            localStorage.setItem("favorites", JSON.stringify(favorites));
            renderFavorites();
        });
        
        // Add to card
        card.appendChild(titleLink);
        card.appendChild(removeBtn);
        
        // Add card to container
        favoritesList.appendChild(card);
    });
}
renderFavorites();

// Search filter
searchInput.addEventListener("keyup", function() {
    const filter = searchInput.value.toLowerCase();
    for (let i = 0; i < recipeList.length; i++) {
        const aTag = recipeList[i].querySelector("a");
        const recipeName = aTag ? aTag.textContent.trim() : recipeList[i].textContent.trim();
        recipeList[i].style.display = recipeName.toLowerCase().includes(filter) ? "" : "none";
    }
});

// Add to Favorites
const favButtons = document.querySelectorAll(".favBtn");
favButtons.forEach(button => {
    button.addEventListener("click", function() {
        const aTag = this.parentElement.querySelector("a");
        const recipeTitle = aTag ? aTag.textContent.trim() : "Unknown";
        const recipeId = aTag ? aTag.getAttribute("href").split("=")[1] : null;

        // Check if already in favorites
        if (!favorites.some(fav => fav.id == recipeId)) {
            favorites.push({id: recipeId, title: recipeTitle});
            localStorage.setItem("favorites", JSON.stringify(favorites));
            renderFavorites();
            alert(`${recipeTitle} added to favorites!`);
        } else {
            alert(`${recipeTitle} is already in favorites!`);
        }
    });
});
