// Search Functionality
const searchInput = document.getElementById("searchInput");
const recipeList = document.getElementById("recipeList").getElementsByTagName("li");

// Favorites storage in browser
let favorites = JSON.parse(localStorage.getItem("favorites") || "[]");

// Render favorites from localStorage
const favoritesList = document.getElementById("favoritesList");
function renderFavorites() {
    favoritesList.innerHTML = "";
    favorites.forEach(recipe => {
        const li = document.createElement("li");

        // Create clickable link to recipe
        const link = document.createElement("a");
        link.href = `view.php?id=${recipe.id}`;
        link.textContent = recipe.title;
        li.appendChild(link);

        // Add Remove button
        const removeBtn = document.createElement("button");
        removeBtn.textContent = "Remove";
        removeBtn.style.marginLeft = "10px";
        removeBtn.addEventListener("click", () => {
            favorites = favorites.filter(fav => fav.id !== recipe.id);
            localStorage.setItem("favorites", JSON.stringify(favorites));
            renderFavorites();
        });

        li.appendChild(removeBtn);
        favoritesList.appendChild(li);
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
