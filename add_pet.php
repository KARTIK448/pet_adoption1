<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    // Move uploaded file to images directory
    move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);

    $stmt = $pdo->prepare("INSERT INTO pets (name, breed, age, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $breed, $age, $description, $image]);

    header("Location: pets.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Pet</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Add New Pet</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Pet Name" required>
        <input type="text" name="breed" placeholder="Breed" required>
        <input type="number" name="age" placeholder="Age" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="image" required>
        <button type="submit">Add Pet</button>
    </form>
</body>
</html>