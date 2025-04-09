<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

$pets = getAllPets($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Pets</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="pets-gallery">
    <div class="container">
        <h2>Available Pets 🐕‍🦺</h2>
        <div class="pet-list">
            <?php if (count($pets) > 0): ?>
                <?php foreach ($pets as $pet): ?>
                    <div class="pet-card">
                        <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                        <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                        <a href="pet_details.php?id=<?php echo $pet['id']; ?>" class="button">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No pets available right now!</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
