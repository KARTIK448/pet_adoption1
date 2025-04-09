<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db/config.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Check credentials (this is a simple example; use prepared statements in production)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, md5($password)]); // Assuming passwords are hashed with MD5
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        redirect('index.php'); // Redirect to homepage after successful login
    } else {
        $error = "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="form-section">
    <div class="form-container">
        <h2>Login 🔐</h2>

        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
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

            <button type="submit" class="button">Login</button>
        </form>

        <p style="text-align:center; margin-top:1rem;">Don't have an account? <a href="register.php">Register</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
