<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Roster</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Cleaning Room</h1>
        <?php

            $table = "RoomClean";
            // SQL query to select all data from the table
            $query = "SELECT rc.*, ml.Name AS ManagedLocationName, r.Name AS RoomName
            FROM RoomClean rc
            INNER JOIN ManagedLocations ml on rc.ManagedLocationId = ml.Id
            INNER JOIN Room r on rc.RoomId = r.Id";
            // Execute query
            // Check if there are any rows returned
            $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
        ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Type</th>
                            <th>Start Time</th>
                            <th>EndTime</th>
                            <th>Managed Location</th>
                            <th>Room</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display the data in the table rows
                        while ($row = $result->fetch_assoc()) {

                            // Construct the URL with rosterId as query parameter
                            echo "<tr>";
                            echo "<td>{$row['Id']}</td>";
                            echo "<td>{$row['ServiceType']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "<td>{$row['ManagedLocationName']}</td>";
                            echo "<td>{$row['RoomName']}</td>";
                            echo "<td>{$row['Notes']}</td>";
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
            // Free result set
            $result->free();

        // Close connection
        $mysqli->close();
        ?>

    </div>
</body>
</html>