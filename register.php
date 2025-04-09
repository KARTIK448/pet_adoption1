<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    

    // Check if passwords match
    
    

        // Check if the username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $error = "Username already exists.";
        } else {
            // Insert the new user into the database
            $hashed_password = md5($password); // Use a stronger hashing algorithm in production
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashed_password])) {
                $_SESSION['user_id'] = $pdo->lastInsertId(); // Log the user in
                redirect('index.php'); // Redirect to homepage after successful registration
            } else {
                $error = "Error registering user.";
            }
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="form-section">
    <div class="form-container">
        <h2>Register ✍️</h2>

        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="button">Register</button>
        </form>

        <p style="text-align:center; margin-top:1rem;">Already have an account? <a href="login.php">Login</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
