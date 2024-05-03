<?php include '../config.php'; ?>
<?php
// Get the service ID from the query string
$roomId = isset($_GET['id']) ? intval($_GET['id']) : null;

// Query to fetch service details including managed location name
$query = "SELECT r.*, ml.Name AS ManagedLocationName
        FROM Room r
        INNER JOIN ManagedLocations ml ON r.ManagedLocationId = ml.Id
        WHERE r.Id = $roomId";
$result = $mysqli->query($query);

// Fetch service details
$roomDetails = $result->fetch_assoc();


// Close database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Room Details</h1>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input required type="text" class="form-control" id="name" name="name" value="<?php echo $roomDetails['Name']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="avail" class="form-label">Availability</label>
                <input required type="text" class="form-control" id="avail" name="avail" value="<?php echo  $roomDetails['Availability']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="booked" class="form-label">Booked For</label>
                <input required type="text" class="form-control" id="booked" name="booked" value="<?php if ($roomDetails['BookedFor'] != NULL){echo  $roomDetails['BookedFor'];} else {echo "Not Booked";} ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="maintenance" class="form-label">Maintenance Status</label>
                <input required type="text" class="form-control" id="maintenance" name="maintenance" value="<?php echo $roomDetails['MaintenanceStatus']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="managedLocation" class="form-label">Managed Location</label>
                <input required type="text" class="form-control" id="managedLocation" name="managedLocation" value="<?php echo $roomDetails['ManagedLocationName']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" disabled><?php echo $roomDetails['Description']; ?></textarea>
            </div>
        </form>
    </div>
</body>

</html>
