<?php
// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $mysqli = new mysqli($host, $user, $password, $database, $port);
    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Prepare and bind parameters
    $stmt = $mysqli->prepare("UPDATE ServiceRecords SET MemberId=?, StaffId=?, ServiceType=?, StartTime=?, EndTime=?, ManagedLocationId=?, Notes=? WHERE Id=?");
    $stmt->bind_param("iisssisi", $memberId, $staffId, $serviceType, $startTime, $endTime, $location, $notes, $recordId);

    // Set parameters from form data
    $memberId = $_POST['member_id'];
    $staffId = $_POST['staff_id'];
    $serviceType = $_POST['service_type'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $location = isset($_POST['managed_location_id']) ? $_POST['managed_location_id'] : null; // Handle if no location is selected
    $notes = $_POST['notes'];
    $recordId = $_POST['record_id']; // Get the record ID from the hidden input field

    // Execute statement
    if ($stmt->execute()) {
        // Redirect to searchrec.php after successful update
        header("Location: search_record.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    // Redirect to searchrec.php if form is not submitted
    header("Location: search_record.php");
    exit();
}
?>
