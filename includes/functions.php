<?php
// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to redirect to a specific page
function redirect($url) {
    header("Location: $url");
    exit();
}

// Function to fetch all pets
function getAllPets($pdo) {
    $stmt = $pdo->query("SELECT * FROM pets WHERE available = 1");
    return $stmt->fetchAll();
}

// Function to fetch a pet by ID
function getPetById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Function to add a new pet
function addPet($pdo, $name, $breed, $age, $description, $image) {
    $stmt = $pdo->prepare("INSERT INTO pets (name, breed, age, description, image) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $breed, $age, $description, $image]);
}

// Function to update a pet
function updatePet($pdo, $id, $name, $breed, $age, $description, $image) {
    $stmt = $pdo->prepare("UPDATE pets SET name = ?, breed = ?, age = ?, description = ?, image = ? WHERE id = ?");
    return $stmt->execute([$name, $breed, $age, $description, $image, $id]);
}

// Function to delete a pet
function deletePet($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM pets WHERE id = ?");
    return $stmt->execute([$id]);
}
?>