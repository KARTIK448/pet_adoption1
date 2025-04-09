<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'] ?? null;
$message = $_SESSION['message'] ?? null;

// Dynamic root path to fix CSS path issue everywhere
$root = rtrim(dirname($_SERVER['PHP_SELF'], 1), '/\\');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - PawsomeAdopt</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- Header Start -->
<header class="site-header">
  <div class="header-container">
    <div class="logo">
      <a href="index.php">🐾 <span>PawsomeAdopt</span></a>
    </div>
    <nav class="nav-links">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="pets.php">All Pets</a></li>
        <li><a href="add_pet.php">Add Pet</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>
<!-- Header End -->



</body>
</html>