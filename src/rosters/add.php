<?php include '../config.php'; ?>
<?php
// Initialize variables for form input
$staffId = $managedLocationId = $serviceType = $startTime = $endTime = $notes = "";

// Function to sanitize form inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to redirect to all_rosters.php
function redirect_to_rosters() {
    header("Location: /rosters/index.php");
    exit();
}

// Function to validate if the chosen start and end times are within the specified staff's availabilities
function validate_availability($staffId, $startTime, $endTime, $mysqli) {
    // Query to fetch the staff's availabilities
    $query = "SELECT StartTime, EndTime FROM Availabilities WHERE StaffId = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $staffId);
    $statement->execute();
    $result = $statement->get_result();

    // Check if the chosen start and end times fall within any of the availabilities
    while ($row = $result->fetch_assoc()) {
        $availabilityStart = strtotime($row['StartTime']);
        $availabilityEnd = strtotime($row['EndTime']);
        $chosenStart = strtotime($startTime);
        $chosenEnd = strtotime($endTime);

        if ($chosenStart >= $availabilityStart && $chosenEnd <= $availabilityEnd) {
            return true; // Chosen times are within an availability
        }
    }

    return false; // Chosen times are not within any availability
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $staffId = sanitize_input($_POST["staff_id"]);
    $managedLocationId = sanitize_input($_POST["managed_location_id"]);
    $serviceType = sanitize_input($_POST["service_type"]);
    $startTime = sanitize_input($_POST["start_time"]);
    $endTime = sanitize_input($_POST["end_time"]);
    $notes = sanitize_input($_POST["notes"]);

    // Validate if the chosen start and end times are within the specified staff's availabilities
    if (!validate_availability($staffId, $startTime, $endTime, $mysqli)) {
        echo "Error: Chosen start and end times are not within the specified staff's availabilities.";
    } else {
        // Insert the roster into the database
        $query = "INSERT INTO Rosters (StaffId, ManagedLocationId, ServiceType, StartTime, EndTime, Notes) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("iissss", $staffId, $managedLocationId, $serviceType, $startTime, $endTime, $notes);
        if ($statement->execute()) {
            // Redirect to all_rosters.php on success
            redirect_to_rosters();
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Roster</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .availability-row:hover {
            cursor: pointer;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Add Roster</h1>

        <!-- List of availabilities -->
        <div class="mb-3">
            <h4>Availabilities</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve and display staff availabilities
                        $query = "SELECT s.Id AS StaffId, s.Name AS StaffName, a.StartTime, a.EndTime FROM Staff s INNER JOIN Availabilities a ON s.Id = a.StaffId";
                        $result = $mysqli->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='availability-row' data-staff-id='{$row['StaffId']}' data-start-time='{$row['StartTime']}' data-end-time='{$row['EndTime']}'>";
                            echo "<td>{$row['StaffName']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <!-- Roster form -->
        <form id="add-roster-form" method="post" action="#">
            <div class="mb-3">
                <label for="staff-select" class="form-label">Select Staff:</label>
                <select class="form-select" id="staff-select" name="staff_id" required>
                    <!-- Populate options dynamically with staff members -->
                    <?php
                    // Retrieve staff members from the database
                    $query = "SELECT Id, Name FROM Staff";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="managed-location-select" class="form-label">Managed Location:</label>
                <select class="form-select" id="managed-location-select" name="managed_location_id" required>
                    <!-- Populate options dynamically with managed locations -->
                    <?php
                    // Retrieve managed locations from the database
                    $query = "SELECT Id, Name FROM ManagedLocations";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="service-type" class="form-label">Service Type:</label>
                <input required type="text" class="form-control" id="service-type" name="service_type" >
            </div>
            <div class="mb-3">
                <label for="start-time" class="form-label">Start Time:</label>
                <input required type="datetime-local" class="form-control" id="start-time" name="start_time" >
            </div>
            <div class="mb-3">
                <label for="end-time" class="form-label">End Time:</label>
                <input required type="datetime-local" class="form-control" id="end-time" name="end_time" >
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes:</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Roster</button>
        </form>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to pre-fill form inputs when clicking on an availability row
        document.querySelectorAll('.availability-row').forEach(row => {
            row.addEventListener('click', () => {
                const staffId = row.getAttribute('data-staff-id');
                const startTime = row.getAttribute('data-start-time');
                const endTime = row.getAttribute('data-end-time');
                document.getElementById('staff-select').value = staffId;
                document.getElementById('start-time').value = startTime.replace(' ', 'T');
                document.getElementById('end-time').value = endTime.replace(' ', 'T');
            });
        });
    </script>
</body>
</html>
