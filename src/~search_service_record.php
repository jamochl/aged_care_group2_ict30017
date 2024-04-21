<?php
// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Initialize variables
$selectedStaffId = isset($_GET['staff_id']) ? $_GET['staff_id'] : null;
$selectedStaffName = '';

// Fetch all staff members
$mysqli = new mysqli($host, $user, $password, $database, $port);
$staff_query = "SELECT Id, Name FROM Staff";
$staff_result = $mysqli->query($staff_query);

// Fetch the name of the selected staff member
if ($selectedStaffId) {
    $stmt = $mysqli->prepare("SELECT Name FROM Staff WHERE Id = ?");
    $stmt->bind_param("i", $selectedStaffId);
    $stmt->execute();
    $stmt->bind_result($selectedStaffName);
    $stmt->fetch();
    $stmt->close();
}
$mysqli->close();

// Fetch service records based on selected staff ID with staff name
$service_records = [];
if ($selectedStaffId) {
    $mysqli = new mysqli($host, $user, $password, $database, $port);
    $stmt = $mysqli->prepare("SELECT sr.Id, sr.MemberId, s.Name AS StaffName, sr.ServiceType, sr.StartTime, sr.EndTime, sr.ManagedLocationId, sr.Notes FROM ServiceRecords sr JOIN Staff s ON sr.StaffId = s.Id WHERE s.Id = ?");
    $stmt->bind_param("i", $selectedStaffId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $service_records[] = $row;
    }
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Records by Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            &gt; <?php generateBreadcrumbs(); ?>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Service Records for <?php echo isset($selectedStaffName) ? $selectedStaffName : ''; ?></h2>
            <a href="/rosters/index.php" class="btn btn-primary">Return to Roster</a>
        </div>
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET">
            <div class="mb-3">
                <label for="staff_id" class="form-label">Select Staff:</label>
                <select id="staff_id" name="staff_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Please select staff</option>
                    <?php while ($row = $staff_result->fetch_assoc()) : ?>
                        <option value="<?php echo $row['Id']; ?>" <?php echo $selectedStaffId == $row['Id'] ? 'selected' : ''; ?>><?php echo $row['Name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </form>

        <?php
        // Show service records for selected staff member
        if (isset($_GET['staff_id'])) {
            if ($service_records) {
                echo "<table class='table'>";
                echo "<thead><tr><th>Service Type</th><th>Start Time</th><th>End Time</th><th>Location</th><th>Notes</th><th>Action</th></tr></thead><tbody>";
                foreach ($service_records as $record_row) {
                    echo "<tr>";
                    echo "<td>" . $record_row['ServiceType'] . "</td>";
                    echo "<td>" . $record_row['StartTime'] . "</td>";
                    echo "<td>" . $record_row['EndTime'] . "</td>";
                    echo "<td>" . $record_row['ManagedLocationId'] . "</td>";
                    echo "<td>" . $record_row['Notes'] . "</td>";
                    echo "<td><a href='update_record.php?id=" . $record_row['Id'] . "' class='btn btn-primary'>Update</a></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No service records found for selected staff member.";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
