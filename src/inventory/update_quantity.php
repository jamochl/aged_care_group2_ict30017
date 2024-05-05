<?php
include '../config.php';

// Check if POST data exists
if(isset($_POST['newQuantity']) && isset($_POST['itemId'])) {
    // Sanitize input
    $newQuantity = intval($_POST['newQuantity']);
    $itemId = intval($_POST['itemId']);

    // Update quantity in the database
    $stmt = $mysqli->prepare("UPDATE Inventory SET Quantity = ? WHERE Id = ?");
    $stmt->bind_param("ii", $newQuantity, $itemId);

    if ($stmt->execute()) {
        // Redirect back to index.php after successful update
        header("Location: index.php");
        exit();
    } else {
        // Handle database error
        echo "Error updating quantity: " . $mysqli->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle invalid request
    echo "Invalid request.";
}

// Close the database connection
$mysqli->close();
?>
