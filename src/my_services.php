<?php
session_start();
// Get the roster ID from the query string
$rosterId = isset($_GET['rosterid']) ? intval($_GET['rosterid']) : null;
$staffId = isset($_SESSION['staffid']) ? intval($_SESSION['staffid']) : null;

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
    <title>Service Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Service Records</h1>
        <?php
        // Query to fetch service records related to a specific roster
        if ($rosterId != null) {
            $query = "SELECT sr.*, r.ServiceType, r.StartTime AS RosterStartTime, r.EndTime AS RosterEndTime, ml.Name AS ManagedLocationName, s.Name AS StaffName, m.FirstName AS MemberFirstName, m.LastName AS MemberLastName
                    FROM ServiceRecords sr
                    INNER JOIN Rosters r ON sr.RosterId = r.Id
                    INNER JOIN Staff s ON r.StaffId = s.Id
                    INNER JOIN Members m ON sr.MemberId = m.Id
                    INNER JOIN ManagedLocations ml ON sr.ManagedLocationId = ml.Id
                    WHERE r.Id = ?";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("i", $rosterId);
            $statement->execute();
            $result = $statement->get_result();
        } else {
            $query = "SELECT sr.*, r.ServiceType, r.StartTime AS RosterStartTime, r.EndTime AS RosterEndTime, ml.Name AS ManagedLocationName, s.Name AS StaffName, m.FirstName AS MemberFirstName, m.LastName AS MemberLastName
                    FROM ServiceRecords sr
                    INNER JOIN Rosters r ON sr.RosterId = r.Id
                    INNER JOIN Staff s ON r.StaffId = s.Id
                    INNER JOIN Members m ON sr.MemberId = m.Id
                    INNER JOIN ManagedLocations ml ON sr.ManagedLocationId = ml.Id";
            $statement = $mysqli->prepare($query);
            $statement->execute();
            $result = $statement->get_result();
        }

        if ($result->num_rows > 0) {
        ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Member</th>
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
                            // echo "<pre>";
                            // print_r($row);
                            // echo "</pre>";

                            // Construct the URL with serviceId as query parameter
                            $url = "service_record.php?id=" . $row['Id'];
                            $urlEdit = "edit_service_record.php?id=" . $row['Id'];
                            echo "<tr>";
                            echo "<td>{$row['StaffName']}</td>";
                            echo "<td>{$row['MemberFirstName']} {$row['MemberLastName']}</td>";
                            echo "<td>{$row['ServiceType']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "<td>{$row['ManagedLocationName']}</td>";
                            echo "<td>{$row['Notes']}</td>";
                            echo "<td><a href='{$url}' class='mx-2 btn btn-primary add-button'>View Record</a><a href='{$urlEdit}' class='btn btn-primary add-button'>Edit Record</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        } else {
            echo "<p>No service history for this roster or staff</p>";
        }
        ?>
    </div>
</body>

</html>
