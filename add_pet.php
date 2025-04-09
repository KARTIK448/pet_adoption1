<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $description = $_POST["description"];
    
    // Handle image upload
    $image = $_FILES["image"]["name"];
    $target = "images/" . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    $stmt = $pdo->prepare("INSERT INTO pets (name, breed, age, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $breed, $age, $description, $image]);

    $success = "Pet added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a New Pet</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="form-section">
  <div class="form-container">
    <h2>Add a New Pet 🐶</h2>

    <?php if (isset($success)): ?>
      <p class="success-message"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Pet Name</label>
        <input type="text" name="name" id="name" required>
      </div>

      <div class="form-group">
        <label for="breed">Breed</label>
        <input type="text" name="breed" id="breed" required>
      </div>

      <div class="form-group">
        <label for="age">Age (in years)</label>
        <input type="number" name="age" id="age" min="0" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image" accept="image/*" required>
      </div>

      <button type="submit" class="button">Add Pet</button>
    </form>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
