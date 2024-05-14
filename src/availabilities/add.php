<?php include '../config.php'; ?>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $mysqli->prepare("INSERT INTO Availabilities (StartTime, EndTime, StaffId) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $startTime, $endTime, $staffId);

    // Set parameters from form data
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];

    // Get staff ID from session
    $staffId = $_SESSION['staffid'];

    // Execute statement
    if ($stmt->execute()) {
        header("Location: /rosters/my.php");
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
    <title>Add New Availability</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h2>Add New Availability</h2>
        <form action="#" method="post">
            <div class="mb-3">
                <!-- Remove staff_id field -->
                <!-- Set staff ID from session -->
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time:</label>
                <!-- Set default value to current date and time -->
                <input required type="datetime-local" id="start_time" name="start_time" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time:</label>
                <!-- Set default value to current date and time -->
                <input required type="datetime-local" id="end_time" name="end_time" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/rosters/index.php" class="btn btn-secondary">Return to Main Page</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
