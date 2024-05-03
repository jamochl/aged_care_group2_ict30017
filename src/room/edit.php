<?php
// Include database connection and breadcrumbs function
include '../config.php';

// Initialize variables
$roomId = isset($_GET['id']) ? intval($_GET['id']) : null;
$errors = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $avail = $_POST['avail'];
    $booked = isset($_POST['booked']) ? intval($_POST['booked']) : null; // Set $booked to null if not selected
    $maintenance = $_POST['maintenance'];
    $managedLocationId = $_POST['managedLocationId'];
    $desc = $_POST['desc'];

    // Convert null value to SQL NULL
    $bookedSql = $booked !== null ? "'$booked'" : "NULL";

    // Update query
    $updateQuery = "UPDATE Room 
                    SET Name = '$name', 
                        Availability = '$avail', 
                        BookedFor = $bookedSql, 
                        MaintenanceStatus = '$maintenance', 
                        ManagedLocationId = '$managedLocationId',
                        Description = '$desc'
                    WHERE Id = $roomId";

    // Perform update
    try {
        if ($mysqli->query($updateQuery)) {
            // Redirect to view.php after successful update
            header("Location: view.php?id=$roomId");
            exit();
        } else {
            // Error handling if update fails
            $errors[] = "Update failed: " . $mysqli->error;
        }
    } catch (Exception $e) {
        // Exception handling
        $errors[] = "Error: " . $e->getMessage();
    }
}

// Fetch room details for pre-filling the form
$query = "SELECT r.*, ml.Name AS ManagedLocationName
          FROM Room r
          INNER JOIN ManagedLocations ml ON r.ManagedLocationId = ml.Id
          WHERE r.Id = $roomId";
$result = $mysqli->query($query);
$roomDetails = $result->fetch_assoc();

// Fetch managed locations for dropdown
$managedLocationsQuery = "SELECT * FROM ManagedLocations";
$managedLocationsResult = $mysqli->query($managedLocationsQuery);

// Fetch members for dropdown (assuming BookedFor field)
$membersQuery = "SELECT Id, CONCAT(FirstName, ' ', LastName) AS FullName FROM Members";
$membersResult = $mysqli->query($membersQuery);

// Fetch maintenance statuses for dropdown
$maintenanceStatuses = ["Clean", "Under Maintenance", "Needs Repair"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <!-- Display the generated breadcrumbs -->
        <?php generateBreadcrumbs(); ?>
        
        <h1>Edit Room Details</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input required type="text" class="form-control" id="name" name="name" value="<?php echo $roomDetails['Name']; ?>">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"><?php echo $roomDetails['Description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="avail" class="form-label">Availability</label>
                <select class="form-select" id="avail" name="avail">
                    <option value="1" <?php echo $roomDetails['Availability'] == 1 ? 'selected' : ''; ?>>Available</option>
                    <option value="0" <?php echo $roomDetails['Availability'] == 0 ? 'selected' : ''; ?>>Unavailable</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="booked" class="form-label">Booked For</label>
                <select class="form-select" id="booked" name="booked">
                    <option value="">Not Booked</option>
                    <?php while ($member = $membersResult->fetch_assoc()) : ?>
                        <option value="<?php echo $member['Id']; ?>" <?php echo $member['Id'] == $roomDetails['BookedFor'] ? 'selected' : ''; ?>><?php echo $member['FullName']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="maintenance" class="form-label">Maintenance Status</label>
                <select class="form-select" id="maintenance" name="maintenance">
                    <?php foreach ($maintenanceStatuses as $status) : ?>
                        <option value="<?php echo $status; ?>" <?php echo $status == $roomDetails['MaintenanceStatus'] ? 'selected' : ''; ?>><?php echo $status; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="managedLocation" class="form-label">Managed Location</label>
                <select class="form-select" id="managedLocation" name="managedLocationId">
                    <?php while ($location = $managedLocationsResult->fetch_assoc()) : ?>
                        <option value="<?php echo $location['Id']; ?>" <?php echo $location['Id'] == $roomDetails['ManagedLocationId'] ? 'selected' : ''; ?>><?php echo $location['Name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
