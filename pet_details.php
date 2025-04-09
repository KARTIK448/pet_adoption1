<?php
include 'db/config.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pet['name']); ?> Details</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($pet['name']); ?></h1>
    <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
    <p>Breed: <?php echo htmlspecialchars($pet['breed']); ?></p>
    <p>Age: <?php echo htmlspecialchars($pet['age']); ?> years</p>
    <p><?php echo htmlspecialchars($pet['description']); ?></p>
    <a href="pets.php">Back to Pets</a>
</body>
</html>