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
    $staffId = $_POST['staff_id'];

    // Execute statement
    if ($stmt->execute()) {
        echo "New availability added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $mysqli->close();
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
            &gt; <?php generateBreadcrumbs(); ?>
        </div>
        <h2>Add New Availability</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="mb-3">
                <label for="staff_id" class="form-label">Staff:</label>
                <select id="staff_id" name="staff_id" class="form-select" required>
                    <option value="">Please select staff</option>
                    <?php
                    // Fetch Staff IDs and names
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
                <label for="start_time" class="form-label">Start Time:</label>
                <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">End Time:</label>
                <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/rosters/index.php" class="btn btn-secondary">Return to Main Page</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
