// Example JavaScript functionality

// Function to confirm deletion of a pet
function confirmDelete() {
    return confirm("Are you sure you want to delete this pet?");
}

// Add event listeners if needed
document.addEventListener("DOMContentLoaded", function() {
    // Example: Attach confirmDelete to delete buttons
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            if (!confirmDelete()) {
                event.preventDefault(); // Prevent the default action if not confirmed
            }
        });
    });
});