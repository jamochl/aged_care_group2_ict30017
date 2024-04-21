<?php
// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Check if record ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to search_record.php if ID is not provided
    header("Location: search_record.php");
    exit();
}

// Retrieve record details using the ID from the URL parameter
$recordId = $_GET['id'];
$mysqli = new mysqli($host, $user, $password, $database, $port);
$stmt = $mysqli->prepare("SELECT * FROM ServiceRecords WHERE Id = ?");
$stmt->bind_param("i", $recordId);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
    <div class="container mt-5">
        <h2>Update Service Record</h2>
        <form action="update_handler.php" method="POST">
            <!-- Hidden input field to pass record ID -->
            <input type="hidden" name="record_id" value="<?php echo $record['Id']; ?>">
            
            <!-- Member dropdown -->
            <div class="mb-3">
                <label for="member_id" class="form-label">Member:</label>
                <select id="member_id" name="member_id" class="form-select">
                    <option value="">Please select member</option>
                    <?php
                    $mysqli = new mysqli($host, $user, $password, $database, $port);
                    $member_query = "SELECT Id, CONCAT(FirstName, ' ', LastName) AS FullName FROM Members";
                    $member_result = $mysqli->query($member_query);
                    while ($row = $member_result->fetch_assoc()) {
                        $selected = $record['MemberId'] == $row['Id'] ? 'selected' : '';
                        echo "<option value='" . $row['Id'] . "' $selected>" . $row['FullName'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>

            <!-- Staff dropdown -->
            <div class="mb-3">
                <label for="staff_id" class="form-label">Staff:</label>
                <select id="staff_id" name="staff_id" class="form-select">
                    <option value="">Please select staff</option>
                    <?php
                    $mysqli = new mysqli($host, $user, $password, $database, $port);
                    $staff_query = "SELECT Id, Name FROM Staff";
                    $staff_result = $mysqli->query($staff_query);
                    while ($row = $staff_result->fetch_assoc()) {
                        $selected = $record['StaffId'] == $row['Id'] ? 'selected' : '';
                        echo "<option value='" . $row['Id'] . "' $selected>" . $row['Name'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>
            
            <!-- Service type dropdown -->
            <select id="service_type" name="service_type" class="form-select" required>
                <option value="">Select Service Type</option>
                <option value="Cleaning" <?php echo ($record['ServiceType'] == 'Cleaning') ? 'selected' : ''; ?>>Cleaning</option>
                <option value="Caring" <?php echo ($record['ServiceType'] == 'Caring') ? 'selected' : ''; ?>>Caring</option>
                <option value="Consulatation" <?php echo ($record['ServiceType'] == 'Consulatation') ? 'selected' : ''; ?>>Consulatation</option>
                <option value="Special_request" <?php echo ($record['ServiceType'] == 'Special_request') ? 'selected' : ''; ?>>Special Request</option>
            </select>


            <!-- Start time input -->
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time:</label>
                <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($record['StartTime'])); ?>" required>
            </div>

            <!-- End time input -->
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time:</label>
                <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($record['EndTime'])); ?>" required>
            </div>

            <!-- Managed location dropdown -->
            <div class="mb-3">
                <label for="managed_location_id" class="form-label">Managed Location:</label>
                <select id="managed_location_id" name="managed_location_id" class="form-select">
                    <option value="">Please select managed location</option>
                    <?php
                    $mysqli = new mysqli($host, $user, $password, $database, $port);
                    $location_query = "SELECT Id, Name FROM ManagedLocations";
                    $location_result = $mysqli->query($location_query);
                    while ($row = $location_result->fetch_assoc()) {
                        $selected = $record['ManagedLocationId'] == $row['Id'] ? 'selected' : '';
                        echo "<option value='" . $row['Id'] . "' $selected>" . $row['Name'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>

            <!-- Notes textarea -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes:</label>
                <textarea id="notes" name="notes" class="form-control" rows="4"><?php echo $record['Notes']; ?></textarea>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
