<?php include '../config.php'; ?>
<?php
// Get the service ID from the query string
$serviceId = isset($_GET['id']) ? intval($_GET['id']) : null;

// Query to fetch service details including managed location name
$query = "SELECT sr.*, ml.Name AS ManagedLocationName
        FROM ServiceRecords sr
        INNER JOIN ManagedLocations ml ON sr.ManagedLocationId = ml.Id
        WHERE sr.Id = ?";
$statement = $mysqli->prepare($query);
$statement->bind_param("i", $serviceId);
$statement->execute();
$result = $statement->get_result();

// Fetch service details
$serviceDetails = $result->fetch_assoc();

// Close statement
$statement->close();

// Close database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            &gt; <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Service Record</h1>
        <form>
            <div class="mb-3">
                <label for="serviceType" class="form-label">Service Type</label>
                <input type="text" class="form-control" id="serviceType" name="serviceType" value="<?php echo $serviceDetails['ServiceType']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="startTime" class="form-label">Start Time</label>
                <input type="datetime-local" class="form-control" id="startTime" name="startTime" value="<?php echo date('Y-m-d\TH:i', strtotime($serviceDetails['StartTime'])); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">End Time</label>
                <input type="datetime-local" class="form-control" id="endTime" name="endTime" value="<?php echo date('Y-m-d\TH:i', strtotime($serviceDetails['EndTime'])); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="managedLocation" class="form-label">Managed Location</label>
                <input type="text" class="form-control" id="managedLocation" name="managedLocation" value="<?php echo $serviceDetails['ManagedLocationName']; ?>" disabled>
                <input type="hidden" name="managedLocationId" value="<?php echo $serviceDetails['ManagedLocationId']; ?>">
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" disabled><?php echo $serviceDetails['Notes']; ?></textarea>
            </div>
        </form>
    </div>
</body>

</html>
