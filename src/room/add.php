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
    $description = $_POST['description'];
    $availability = $_POST['availability'];
    $managedLocationId = $_POST['managed_location_id'];
    $maintenanceStatus = $_POST['maintenance_status']; // Retrieve maintenance status

    // Construct the SQL query
    $sql = "INSERT INTO Room (Name, Description, Availability, ManagedLocationId, MaintenanceStatus) 
            VALUES ('$name', '$description', '$availability', '$managedLocationId', '$maintenanceStatus')";

    // Execute the query
    if ($mysqli->query($sql) === TRUE) {
        $message = "Room added successfully!";
    } else {
        $error = "Error adding room: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
    <div class="container mt-5">
        <h1>Add Room</h1>
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
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <select class="form-select" id="availability" name="availability">
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="maintenance_status" class="form-label">Maintenance Status</label>
                <select class="form-select" id="maintenance_status" name="maintenance_status">
                    <option value="Functional">Functional</option>
                    <option value="Not Suitable">Not Suitable</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="managed_location_id" class="form-label">Managed Location</label>
                <select class="form-select" id="managed_location_id" name="managed_location_id" required>
                    <?php
                    // Retrieve managed locations from the database
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
