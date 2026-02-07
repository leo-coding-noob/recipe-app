<!-- <?php
// session_start();
// include 'config.php';
// $error = "";

// if(isset($_POST['login'])){
//     $email = $conn->real_escape_string($_POST['email']);
//     $password = $_POST['password'];

//     $sql = "SELECT * FROM users WHERE email='$email'";
//     $result = $conn->query($sql);

//     if($result->num_rows == 1){
//         $row = $result->fetch_assoc();
//         if(password_verify($password, $row['password'])){
//             $_SESSION['user_id'] = $row['id'];
//             $_SESSION['username'] = $row['username'];
//             header("Location: index.php");
//             exit;
//         } else {
//             $error = "Incorrect password!";
//         }
//     } else {
//         $error = "No user found with this email!";
//     }
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>
<p>Don't have an account? <a href="signup.php">Signup</a></p>
</body>
</html> -->


<!-- new code  -->
 <?php
session_start();
include 'config.php';
$error = "";

if(isset($_POST['login'])){
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Recipe App</title>
    <!-- Link to MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Link to LOGIN CSS -->
    <link rel="stylesheet" href="../css/login-style.css">
</head>
<body>
    <!-- Header (Same as other pages) -->
    <header>
        <h1>Recipe App</h1>
        <nav>
          
            <a href="login.php">Login</a> |
            <a href="signup.php">Sign Up</a>
        </nav>
    </header>

    <!-- Login Section -->
    <main class="login-container">
        <div class="login-box">
            <h2>Login to Your Account</h2>
            
            <?php if($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Enter your password">
                </div>
                
                <button type="submit" name="login" class="login-btn">Login</button>
            </form>
            
            <p class="signup-link">
                Don't have an account? <a href="signup.php">Create one here</a>
            </p>
        </div>
    </main>

    <!-- Footer (Same as other pages) -->
    <footer>
        <p>&copy; 2026 Recipe App. Cook delicious meals!</p>
    </footer>
</body>
</html>