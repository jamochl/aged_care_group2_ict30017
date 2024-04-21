<?php
session_start();
// Get the staff ID from the query string
$staffId = isset($_SESSION['staffid']) ? intval($_SESSION['staffid']) : 1;

// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosters</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Rosters</h1>
        <?php
        // Query to fetch rosters
        $query = "SELECT r.*, s.Name AS StaffName, ml.Name AS ManagedLocationName 
                FROM Rosters r
                INNER JOIN Staff s ON r.StaffId = s.Id
                INNER JOIN ManagedLocations ml ON r.ManagedLocationId = ml.Id";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
        ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Service Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Managed Location</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display the data in the table rows
                        while ($row = $result->fetch_assoc()) {
                            // Construct the URL with rosterId as query parameter
                            $url = "my_services.php?rosterid=" . $row['Id'];
                            $urlEdit = "edit_roster.php?id=" . $row['Id'];
                            echo "<tr>";
                            echo "<td>{$row['StaffName']}</td>";
                            echo "<td>{$row['ServiceType']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "<td>{$row['ManagedLocationName']}</td>";
                            echo "<td>{$row['Notes']}</td>";
                            echo "<td><a href='{$url}' class='btn btn-primary add-button'>View Related Services</a></td>";
                            echo "<td><a href='{$urlEdit}' class='btn btn-primary add-button'>Edit</a></td>";
                            echo "</tr>";
                        }

                        // Close database connection
                        // $mysqli->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } else {
            echo "<p>Nothing rostered for you at the moment</p>";
        }
        ?>

        <?php
        // Table names
        $availabilitiesTable = "Availabilities";
        ?>

        <?php
        // SQL query to retrieve availabilities with staff names
        $availabilitiesQuery = "SELECT Availabilities.Id, Availabilities.StartTime, Availabilities.EndTime, Availabilities.StaffId, Staff.Name AS StaffName FROM $availabilitiesTable JOIN Staff ON Availabilities.StaffId = Staff.Id";

        // Execute the availabilities query
        $availabilitiesResult = $mysqli->query($availabilitiesQuery);
        ?>

        <h1>Availabilities</h1>

        <?php
        // Display availabilities with staff names in a table
        if ($availabilitiesResult->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr>";
            echo "<th>Staff Name</th>";
            echo "<th>Start Time</th>";
            echo "<th>End Time</th>";
            echo "<th>Actions</th>";
            echo "</tr></thead><tbody>";
            while ($row = $availabilitiesResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['StaffName']}</td>";
                echo "<td>{$row['StartTime']}</td>";
                echo "<td>{$row['EndTime']}</td>";
                echo "<td><a href='edit_availability.php?id={$row['Id']}' class='btn btn-primary add-button'>Edit Availabilities</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>You have not specified any availabilities</p>";
        }
        $availabilitiesResult->free();
        
        // Button to add a new availability
        echo "<button onclick=\"window.location.href='add_roster.php'\" class=\"btn btn-primary add-button button-gap\">Create Roster</button>";

        // Close connection
        $mysqli->close();
        ?>
    </div>
</body>

</html>