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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <h1>My Recipe App</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="add.php">Add Recipe</a> |
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Recipes</h2>

    <!-- Search bar -->
    <input type="text" id="searchInput" placeholder="Search recipes...">

    <ul id="recipeList">
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <li style="display:flex; gap:15px; align-items:center;">
                    
                    <!-- Recipe Image -->
                    <?php if(!empty($row['image'])): ?>
                        <img 
                            src="../uploads/<?= htmlspecialchars($row['image']) ?>" 
                            alt="Recipe Image"
                            style="width:100px;height:80px;object-fit:cover;border-radius:6px;"
                        >
                    <?php else: ?>
                        <div style="width:100px;height:80px;background:#ddd;border-radius:6px;
                                    display:flex;align-items:center;justify-content:center;font-size:12px;">
                            No Image
                        </div>
                    <?php endif; ?>

                    <!-- Recipe Title -->
                    <a href="view.php?id=<?= $row['id'] ?>" style="flex:1;">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>

                    <!-- Buttons -->
                    <button class="favBtn">Add to Favorites</button>

                    <a href="edit.php?id=<?= $row['id'] ?>">
                        <button>Edit</button>
                    </a>

                    <a href="delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this recipe?');">
                        <button>Delete</button>
                    </a>

                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No recipes found.</li>
        <?php endif; ?>
    </ul>

    <h3>My Favorites:</h3>
    <ul id="favoritesList"></ul>
</main>

<footer>
    <p>&copy; 2026 Recipe App</p>
</footer>

<script src="../js/script.js"></script>
</body>
</html>
