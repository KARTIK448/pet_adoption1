<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    redirect('login.php'); // Redirect to login if not logged in
}

// Fetch a few pets to display on the homepage
$pets = getAllPets($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Pet Adoption</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    
        <h2>Featured Pets</h2>
        <div class="pet-list">
            <?php if (count($pets) > 0): ?>
                <?php foreach ($pets as $pet): ?>
                    <div class="pet">
                        <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                        <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                        <p>Breed: <?php echo htmlspecialchars($pet['breed']); ?></p>
                        <p>Age: <?php echo htmlspecialchars($pet['age']); ?> years</p>
                        <p><?php echo htmlspecialchars($pet['description']); ?></p>
                        <a href="pet_details.php?id=<?php echo $pet['id']; ?>" class="button">View Details</a>
                        <form action="delete_pet.php" method="post" style="display:inline;">
                            <input type="hidden" name="pet_id" value="<?php echo $pet['id']; ?>">
                            <button type="submit" class="button" onclick="return confirm('Are you sure you want to delete this pet?');">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No pets available at the moment. Please check back later!</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="add-pet-button">
            <a href="add_pet.php" class="button">Add New Pet</a>
        </div>


    <?php include 'includes/footer.php'; ?>
</body>
</html>