<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$pet_id = $_GET['id'];

// Fetch pet info
$stmt = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
$stmt->execute([$pet_id]);
$pet = $stmt->fetch();

if (!$pet) {
    echo "Pet not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $description = $_POST["description"];

    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    } else {
        $image = $pet['image'];
    }

    $stmt = $pdo->prepare("UPDATE pets SET name=?, breed=?, age=?, description=?, image=? WHERE id=?");
    $stmt->execute([$name, $breed, $age, $description, $image, $pet_id]);

    $success = "Pet updated successfully!";
    $pet['name'] = $name;
    $pet['breed'] = $breed;
    $pet['age'] = $age;
    $pet['description'] = $description;
    $pet['image'] = $image;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pet</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="form-section">
    <div class="form-container">
        <h2>Edit Pet 🛠️</h2>

        <?php if (isset($success)): ?>
            <p class="success-message"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Pet Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($pet['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="breed">Breed</label>
                <input type="text" name="breed" id="breed" value="<?php echo htmlspecialchars($pet['breed']); ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Age (in years)</label>
                <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($pet['age']); ?>" min="0" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($pet['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                <p>Current: <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" style="width: 100px; height: auto; margin-top: 0.5rem;"></p>
            </div>

            <button type="submit" class="button">Save Changes</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
