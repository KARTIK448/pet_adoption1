<?php
session_start();
include 'db/config.php';

$stmt = $pdo->query("SELECT * FROM pets WHERE available = 1");
$pets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Pets</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Available Pets for Adoption</h1>
    <a href="add_pet.php">Add New Pet (Admin)</a>
    <div class="pet-list">
        <?php foreach ($pets as $pet): ?>
            <div class="pet">
                <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
                <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                <p>Breed: <?php echo htmlspecialchars($pet['breed']); ?></p>
                <p>Age: <?php echo htmlspecialchars($pet['age']); ?> years</p>
                <p><?php echo htmlspecialchars($pet['description']); ?></p>
                <a href="pet_details.php?id=<?php echo $pet['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>