<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

if (!isset($_GET['id'])) {
    redirect('index.php');
}

$pet_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
$stmt->execute([$pet_id]);
$pet = $stmt->fetch();

if (!$pet) {
    echo "Pet not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pet['name']); ?> - Pet Details</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="pet-details">
    <div class="details-container">
        <h2><?php echo htmlspecialchars($pet['name']); ?> 🐾</h2>
        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>" class="details-img">
        <div class="details-info">
            <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($pet['description']); ?></p>
        </div>
        <a href="index.php" class="button">⬅ Back to List</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
