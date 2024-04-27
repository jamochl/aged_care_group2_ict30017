<?php include '../config.php'; ?>
<?php
// Check if ID is provided via POST request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Set ID from POST data
    $id = $_GET["id"];

    // Prepare and bind parameters
    $stmt = $mysqli->prepare("DELETE FROM Availabilities WHERE Id = ?");
    $stmt->bind_param("i", $id);

    // Execute statement
    if ($stmt->execute()) {
        // Close statement
        $stmt->close();

        // Redirect to the my.php page
        header("Location: /rosters/my.php");
        exit();
    } else {
        // Display error message if deletion fails
        echo "Error: Unable to delete availability.";
    }
} else {
    echo "ERROR 1";
    // Redirect to the my.php page if ID is not provided
    // header("Location: /rosters/my.php");
    exit();
}
?>
