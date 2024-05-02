<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Available Room</h1>
        <?php
            $colCheck = 0;
            // SQL query to select all data from the table
            $query = "SELECT r.*, ml.Name AS ManagedLocationName 
            FROM Room r
            INNER JOIN ManagedLocations ml on r.ManagedLocationId = ml.Id      
            where Availability = 1";
            // Execute query
            $result = $mysqli->query($query);
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table class='table'>";
                echo "<thead><tr>";
                // Fetch table column names
                $field_names = $result->fetch_fields();
                foreach ($field_names as $field) {
                    if ($field == $field_names[4]){
                        echo "<th>Book For</th>";
                    } else if ($field == $field_names[5]) {
                        echo "<th>Status</th>"; 
                    } else if ($field == $field_names[6]) {
                        continue;
                    } else if ($field == $field_names[7]) {
                        echo "<th>Building</th>";
                    } else {
                        echo "<th>$field->name</th>";
                    }
                }
                // Add an extra column for actions
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        if ($colCheck == 6 && $value == $row['ManagedLocationId']){
                            continue;
                        }
                        if ($value == $row['ManagedLocationName']){
                            echo "<td>$value</td>";
                            $colCheck = 0;
                            continue;
                        }
                        if ($colCheck == 3){
                            echo "<td>Available</td>";
                            $colCheck += 1;
                            continue;
                        }
                        if ($colCheck == 4){
                            echo "<td>Not Booked</td>";
                            $colCheck += 1;
                        } else {
                            echo "<td>$value</td>";
                            $colCheck += 1;
                        }
                       
                    }
                    // Add view and edit buttons with links
                    echo "<td><a href='/room/view.php?id={$row['Id']}' class='btn btn-primary'>View</a> <a href='/staff/edit.php?id={$row['Id']}' class='btn btn-primary'>Edit</a></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No available room.";
            }
            // Free result set
            $result->free();

        // Close connection

        ?>
        <h1>Booked Room</h1>
        <?php
            $colCheck = 0;
            // SQL query to select all data from the table
            $query = "SELECT r.*, ml.Name AS ManagedLocationName 
            FROM Room r
            INNER JOIN ManagedLocations ml on r.ManagedLocationId = ml.Id      
            where Availability = 0";
            // Execute query
            $result = $mysqli->query($query);
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table class='table'>";
                echo "<thead><tr>";
                // Fetch table column names
                $field_names = $result->fetch_fields();
                foreach ($field_names as $field) {
                    if ($field == $field_names[4]){
                        echo "<th>Book For</th>";
                    } else if ($field == $field_names[5]) {
                        echo "<th>Status</th>"; 
                    } else if ($field == $field_names[6]) {
                        continue;
                    } else if ($field == $field_names[7]) {
                        echo "<th>Building</th>";
                    } else {
                        echo "<th>$field->name</th>";
                    }
                }
                // Add an extra column for actions
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        if ($colCheck == 6 && $value == $row['ManagedLocationId']){
                            continue;
                        }
                        if ($value == $row['ManagedLocationName']){
                            echo "<td>$value</td>";
                            $colCheck = 0;
                            continue;
                        }
                        if ($colCheck == 3){
                            echo "<td>Booked</td>";
                            $colCheck += 1;
                            continue;
                        } else {
                            echo "<td>$value</td>";
                            $colCheck += 1;
                        }
                       
                    }
                    // Add view and edit buttons with links
                    echo "<td><a href='/room/view.php?id={$row['Id']}' class='btn btn-primary'>View</a> <a href='/staff/edit.php?id={$row['Id']}' class='btn btn-primary'>Edit</a></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No booked room.";
            }
            // Free result set
            $result->free();

        // Close connection
        $mysqli->close();
        ?>
    </div>
</body>
</html>