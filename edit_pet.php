<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: pets.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
$stmt->execute([$id]);
$pet = $stmt->fetch();

if (!$pet) {
    header("Location: pets.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    
    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
    } else {
        $image = $pet['image']; // Keep the old image if no new one is uploaded
    }

    $stmt = $pdo->prepare("UPDATE pets SET name = ?, breed = ?, age = ?, description = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $breed, $age, $description, $image, $id]);

    header("Location: pets.php");
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
    <h1>Edit Pet</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo htmlspecialchars($pet['name']); ?>" required>
        <input type="text" name="breed" value="<?php echo htmlspecialchars($pet['breed']); ?>" required>
        <input type="number" name="age" value="<?php echo htmlspecialchars($pet['age']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($pet['description']); ?></textarea>
        <input type="file" name="image">
        <button type="submit">Update Pet</button>
    </form>
</body>
</html>