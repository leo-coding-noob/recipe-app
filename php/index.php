<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
include 'config.php';

// Fetch recipes from DB
$sql = "SELECT * FROM recipes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipe App</title>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
     <link rel="stylesheet" href="../css/style.css?v=2">
     <link rel="stylesheet" href="../css/favorites.css?v=2">
    
</head>
<body>

<header>
    <h1>My Recipe App</h1>
    <nav>
        <div class="nav-left">
            <a href="index.php">Home</a> |
            <a href="add.php">Add Recipe</a>
        </div>
        <div class="user-info">
            <span class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>
</header>

<main>
    <h2>Recipes</h2>

    <!-- Search bar -->
    <input type="text" id="searchInput" placeholder="Search recipes...">

   <ul id="recipeList">
    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                
                <!-- Recipe Image -->
                <?php if(!empty($row['image'])): ?>
                    <img 
                        src="../uploads/<?= htmlspecialchars($row['image']) ?>" 
                        alt="Recipe Image"
                    >
                <?php else: ?>
                    <div>No Image</div>
                <?php endif; ?>

                <!-- Recipe Title -->
                <a href="view.php?id=<?= $row['id'] ?>">
                    <?= htmlspecialchars($row['title']) ?>
                </a>

                <!-- Buttons -->
                <div class="recipe-buttons">
                    <button class="favBtn">Add to Favorites</button>
                    <a href="edit.php?id=<?= $row['id'] ?>">
                        <button class="edit-btn">Edit</button>
                    </a>
                    <a href="delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this recipe?');">
                        <button class="delete-btn">Delete</button>
                    </a>
                </div>

            </li>
        <?php endwhile; ?>
    <?php else: ?>
        <li>No recipes found.</li>
    <?php endif; ?>
</ul>


<!-- favorite -->
<h3 class="favorites-heading">⭐ My Favorites</h3>
<div class="favorites-container" id="favoritesList">
    <!-- Favorites will be added by JavaScript -->
</div>
</main>


    <footer class="recipe-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3>Recipe App</h3>
            <p class="footer-tagline">Cook, save, share your favorite recipes.</p>
        </div>
        
        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/add-recipe">Add Recipe</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-contact">
            <h4>Contact</h4>
            <p class="contact-email">
                Email: <a href="mailto:contact@recipeapp.com">contact@recipeapp.com</a>
            </p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>© 2026 Recipe App. Made with <span class="heart">❤️</span></p>
    </div>
</footer>


<script src="../js/script.js"></script>
</body>
</html>
