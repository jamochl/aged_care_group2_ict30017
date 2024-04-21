<?php include '../config.php'; ?>
<?php
// Get the staff ID from the query string
$staffId = isset($_SESSION['staffid']) ? intval($_SESSION['staffid']) : 1;
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
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Rosters</h1>
        <?php
        // Query to fetch rosters
        $query = "SELECT r.*, s.Name AS StaffName, ml.Name AS ManagedLocationName 
                FROM Rosters r
                INNER JOIN Staff s ON r.StaffId = s.Id
                INNER JOIN ManagedLocations ml ON r.ManagedLocationId = ml.Id WHERE r.StaffId = $staffId";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
        ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
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
                            $url = "/service_records/my.php?rosterid=" . $row['Id'];
                            echo "<tr>";
                            echo "<td>{$row['ServiceType']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "<td>{$row['ManagedLocationName']}</td>";
                            echo "<td>{$row['Notes']}</td>";
                            echo "<td><a href='{$url}' class='btn btn-primary add-button'>View Related Services</a></td>";
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
        $availabilitiesQuery = "SELECT Availabilities.Id, Availabilities.StartTime, Availabilities.EndTime, Availabilities.StaffId, Staff.Name AS StaffName FROM $availabilitiesTable JOIN Staff ON Availabilities.StaffId = Staff.Id WHERE StaffId = $staffId";

        // Execute the availabilities query
        $availabilitiesResult = $mysqli->query($availabilitiesQuery);
        ?>

        <h1>Availabilities</h1>

        <?php
        // Display availabilities with staff names in a table
        if ($availabilitiesResult->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr>";
            echo "<th>Start Time</th>";
            echo "<th>End Time</th>";
            echo "<th>Actions</th>";
            echo "</tr></thead><tbody>";
            while ($row = $availabilitiesResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['StartTime']}</td>";
                echo "<td>{$row['EndTime']}</td>";
                echo "<td><a href='/availabilities/edit.php?id={$row['Id']}' class='btn btn-primary add-button'>Edit Availabilities</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>You have not specified any availabilities</p>";
        }
        $availabilitiesResult->free();
        
        // Close connection
        $mysqli->close();
        ?>

        <a href="/availabilities/add.php" class="btn btn-primary add-button button-gap">Add Availability</a>
    </div>
</body>

</html>