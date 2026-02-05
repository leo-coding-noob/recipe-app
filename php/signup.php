<?php
session_start();
include 'config.php';
$error = "";

if(isset($_POST['signup'])){
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        $error = "Email already registered!";
    } else {
        $sql = "INSERT INTO users (username, email, password, created_at) 
                VALUES ('$username', '$email', '$password', NOW())";
        if($conn->query($sql) === TRUE){
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
</head>
<body>
<h2>Signup</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Email:<br>
    <input type="email" name="email" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="signup">Signup</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
