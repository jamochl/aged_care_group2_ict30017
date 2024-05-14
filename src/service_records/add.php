<?php include '../config.php'; ?>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $mysqli->prepare("INSERT INTO ServiceRecords (RosterId, MemberId, StaffId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error in preparing SQL statement: " . $mysqli->error);
    }

    $stmt->bind_param("iiisssis", $rosterId, $memberId, $staffId, $serviceType, $startTime, $endTime, $location, $notes);

    // Set parameters from form data
    $rosterId = $_POST['roster_id']; // New field for Roster ID
    $memberId = $_POST['member_id'];
    $staffId = $_POST['staff_id'];
    $serviceType = $_POST['service_type'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $location = isset($_POST['managed_location_id']) ? $_POST['managed_location_id'] : null; // Handle if no location is selected
    $notes = $_POST['notes'];

    // Execute statement
    if ($stmt->execute()) {
        header("Location: /service_records/index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h2>Add New Service Record</h2>
        <form action="#" method="post">
            <!-- New field for Roster ID -->
            <div class="mb-3">
                <label for="roster_id" class="form-label">Roster ID:</label>
                <select id="roster_id" name="roster_id" class="form-select" required>
                    <option value="">Please select roster</option>
                    <?php
                    // Fetch Roster details (start time, end time, and staff name)
                    $roster_query = "SELECT R.Id, R.StaffId, R.StartTime, R.EndTime, S.Name, R.ServiceType FROM Rosters R INNER JOIN Staff S ON R.StaffId = S.Id";
                    $roster_result = $mysqli->query($roster_query);
                    while ($row = $roster_result->fetch_assoc()) {
                        $rosterInfo = "{$row['StartTime']} - {$row['EndTime']} - {$row['ServiceType']} ({$row['Name']})";
                        $selected = isset($_GET['rosterid']) && $_GET['rosterid'] == $row['Id'] ? 'selected' : '';
                        echo "<option staffid='" . $row['StaffId'] . "' starttime='" . $row['StartTime'] . "' endtime='" . $row["EndTime"] . "' value='" . $row['Id'] . "' $selected>$rosterInfo</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="member_id" class="form-label">Member:</label>
                <select id="member_id" name="member_id" class="form-select">
                    <option value="">Please select member</option>
                    <?php
                    // Fetch Member IDs and full names
                    $member_query = "SELECT Id, CONCAT(FirstName, ' ', LastName) AS FullName FROM Members";
                    $member_result = $mysqli->query($member_query);
                    while ($row = $member_result->fetch_assoc()) {
                        echo "<option value='" . $row['Id'] . "'>" . $row['FullName'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="staff_id" class="form-label">Staff:</label>
                <select id="staff_id" name="staff_id" class="form-select">
                    <option value="">Please select staff</option>
                    <?php
                    // Fetch Staff IDs and names
                    $mysqli = new mysqli($host, $user, $password, $database, $port);
                    $staff_query = "SELECT Id, Name FROM Staff";
                    $staff_result = $mysqli->query($staff_query);
                    while ($row = $staff_result->fetch_assoc()) {
                        echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type:</label>
                <select id="service_type" name="service_type" class="form-select" required>
                    <option value="">Select Service Type</option>
                    <option value="Cleaning">Cleaning</option>
                    <option value="Caring">Caring</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Special_request">Special Request</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time:</label>
                <input required type="datetime-local" id="start_time" name="start_time" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time:</label>
                <input required type="datetime-local" id="end_time" name="end_time" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="managed_location_id" class="form-label">Managed Location:</label>
                <select id="managed_location_id" name="managed_location_id" class="form-select">
                    <option value="">Please select managed location</option>
                    <?php
                    // Fetch Managed Location IDs and names
                    $mysqli = new mysqli($host, $user, $password, $database, $port);
                    $location_query = "SELECT Id, Name FROM ManagedLocations";
                    $location_result = $mysqli->query($location_query);
                    while ($row = $location_result->fetch_assoc()) {
                        echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes:</label>
                <textarea id="notes" name="notes" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/rosters/index.php" class="btn btn-secondary">Return to Main Page</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add an event listener to the roster dropdown list -->
    <script>
    document.getElementById('roster_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var staffId = selectedOption.getAttribute('staffid');
        var startTime = selectedOption.getAttribute('starttime');
        var endTime = selectedOption.getAttribute('endtime');

        // Set the staff name to a hidden input field or any other desired element
        document.getElementById('staff_id').value = staffId;
        document.getElementById('start_time').value = startTime;
        document.getElementById('end_time').value = endTime;
    });
    </script>
</body>
</html>
