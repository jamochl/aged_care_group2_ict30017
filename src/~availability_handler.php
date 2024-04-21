<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availabilities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px; /* Add margin to create space between tables and edges of the page */
        }
        table {
            width: calc(100% - 40px); /* Adjust the width to leave a gap on both sides */
            border-collapse: collapse;
            margin: 0 auto; /* Center the tables horizontally */
            margin-bottom: 20px; /* Add some bottom margin for spacing between tables */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .update-button, .delete-button {
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .section-divider {
            width: 100%;
            border-top: 2px solid #ccc;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    // Database connection parameters
    $host = "db";
    $port = "3306";
    $user = "admin";
    $password = "admin";
    $database = "aged_care";

    // Create connection
    $mysqli = new mysqli($host, $user, $password, $database, $port);
    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Handle update and delete actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle update action
        if (isset($_POST['update_availability'])) {
            // Perform update operation
            $availability_id = $_POST['availability_id'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $staff_id = $_POST['staff_id'];
            $update_query = "UPDATE Availabilities SET StartTime = '$start_time', EndTime = '$end_time', StaffId = '$staff_id' WHERE Id = $availability_id";
            if ($mysqli->query($update_query)) {
                echo "Availability entry updated successfully.";
            } else {
                echo "Error updating availability entry: " . $mysqli->error;
            }
        }

        // Handle delete action
        if (isset($_POST['delete_availability'])) {
            // Perform delete operation
            $availability_id = $_POST['availability_id'];
            $delete_query = "DELETE FROM Availabilities WHERE Id = $availability_id";
            if ($mysqli->query($delete_query)) {
                echo "Availability entry deleted successfully.";
            } else {
                echo "Error deleting availability entry: " . $mysqli->error;
            }
        }
    }

    // Table names
    $availabilitiesTable = "Availabilities";
    $staffTable = "Staff";

    // SQL query to retrieve availabilities with staff names
    $availabilitiesQuery = "SELECT Availabilities.Id, Availabilities.StartTime, Availabilities.EndTime, Availabilities.StaffId, Staff.Name AS StaffName FROM $availabilitiesTable JOIN $staffTable ON Availabilities.StaffId = Staff.Id";

    // Execute the availabilities query
    $availabilitiesResult = $mysqli->query($availabilitiesQuery);

    // Display availabilities with staff names in a table
    if ($availabilitiesResult->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr>";
        echo "<th>Staff Name</th>"; // Moved Staff Name column to the top
        echo "<th>Start Time</th>";
        echo "<th>End Time</th>";
        echo "<th>Actions</th>";
        echo "</tr></thead><tbody>";
        while ($row = $availabilitiesResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['StaffName']}</td>"; // Display Staff Name first
            echo "<td>";
            // Update form
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='availability_id' value='{$row['Id']}'>";
            echo "<input type='datetime-local' name='start_time' value='" . date('Y-m-d\TH:i', strtotime($row['StartTime'])) . "' required><br>";
            echo "</td><td>"; // Splitting into multiple columns
            echo "<input type='datetime-local' name='end_time' value='" . date('Y-m-d\TH:i', strtotime($row['EndTime'])) . "' required><br>";
            echo "</td><td>"; // Splitting into multiple columns
            echo "<select name='staff_id'>";
            // Fetch staff list
            $staffQuery = "SELECT Id, Name FROM $staffTable";
            $staffResult = $mysqli->query($staffQuery);
            while ($staffRow = $staffResult->fetch_assoc()) {
                $selected = ($staffRow['Id'] == $row['StaffId']) ? 'selected' : '';
                echo "<option value='{$staffRow['Id']}' $selected>{$staffRow['Name']}</option>";
            }
            echo "</select><br>";
            echo "<button type='submit' name='update_availability' class='btn btn-primary'>Update</button>";
            echo "</form>";
            // Delete form
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='availability_id' value='{$row['Id']}'>";
            echo "<button type='submit' name='delete_availability' class='btn btn-danger'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No data available in $availabilitiesTable";
    }
    $availabilitiesResult->free();

    // Close connection
    $mysqli->close();
    ?>

    <!-- Button to return to edit_availabilities.php -->
    <div class="container mt-3">
        <a href="edit_availabilities.php" class="btn btn-secondary">Return to Edit Availabilities</a>
    </div>

</body>
</html>
