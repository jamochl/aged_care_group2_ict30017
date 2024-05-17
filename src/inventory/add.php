<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include '../config.php';

// Initialize variables for messages
$message = "";
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $purpose = $_POST['purpose'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $managedLocationId = $_POST['managed_location_id'];

    // Construct the SQL query
    $sql = "INSERT INTO Inventory (Name, Purpose, Description, Quantity, ManagedLocationId) 
            VALUES ('$name', '$purpose', '$description', '$quantity', '$managedLocationId')";

    // Execute the query
    if ($mysqli->query($sql) === TRUE) {
        header("location: /inventory/index.php");
        exit;
    } else {
        $error = "Error adding inventory item: " . $mysqli->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Add Inventory</h1>
        <?php if(!empty($message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <?php if(!empty($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="#">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
                <label for="managed_location_id" class="form-label">Managed Location</label>
                <select class="form-select" id="managed_location_id" name="managed_location_id" required>
                    <?php
                    // Retrieve non-personal managed locations from the database
                    $query = "SELECT Id, Name FROM ManagedLocations WHERE Personal = 0";
                    $result = $mysqli->query($query);

                    // Check if there are any rows returned
                    if ($result->num_rows > 0) {
                        // Loop through each row and add an option to the select dropdown
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
