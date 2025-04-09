<?php
session_start();
include 'db/config.php';
include 'includes/functions.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    redirect('login.php'); // Redirect to login if not logged in
}

// Check if pet_id is set
if (isset($_POST['pet_id'])) {
    $pet_id = intval($_POST['pet_id']); // Sanitize input

    // Prepare and execute the delete statement
    $stmt = $pdo->prepare("DELETE FROM pets WHERE id = ?");
    if ($stmt->execute([$pet_id])) {
        // Redirect back to the index page with a success message
        $_SESSION['message'] = "Pet deleted successfully.";
    } else {
        // Redirect back with an error message
        $_SESSION['message'] = "Error deleting pet.";
    }
} else {
    $_SESSION['message'] = "No pet ID provided.";
}

// Redirect to the index page
header("Location: index.php");
exit();