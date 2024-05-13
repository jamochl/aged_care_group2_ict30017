<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Inventory</h1>
        <h2>Out of stock</h2>
        <?php
            $table = "Inventory";
            // SQL query to select specific columns from the table and join with ManagedLocations table
            $query = "SELECT i.Id, i.Name, i.Purpose, i.OwnerDetails, i.OwnerType, i.Description, i.Quantity, ml.Name AS ManagedLocationName
                      FROM $table i
                      LEFT JOIN ManagedLocations ml ON i.ManagedLocationId = ml.Id
                      WHERE i.Quantity = 0";
            // Execute query
            $result = $mysqli->query($query);
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table class='table'>";
                echo "<thead><tr>";
                // Explicitly define table headers
                echo "<th>Name</th>";
                echo "<th>Purpose</th>";
                echo "<th>Description</th>";
                echo "<th>Quantity</th>";
                echo "<th>Managed Location</th>";
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Name']}</td>";
                    echo "<td>{$row['Purpose']}</td>";
                    echo "<td>{$row['Description']}</td>";
                    echo "<td>{$row['Quantity']}</td>";
                    echo "<td>{$row['ManagedLocationName']}</td>";
                    echo "<td>";
                    echo "<a href='view.php?id=" . $row['Id'] . "' class='btn btn-primary ml-2'>View</a>";
                    echo "<a href='edit.php?id=" . $row['Id'] . "' class='btn btn-primary'>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No out-of-stock data available in $table";
            }
            // Free result set
            $result->free();
        ?>
        <hr>
        <h2>In stock</h2>
        <?php
            $table = "Inventory";
            // SQL query to select specific columns from the table and join with ManagedLocations table
            $query = "SELECT i.Id, i.Name, i.Purpose, i.OwnerDetails, i.OwnerType, i.Description, i.Quantity, ml.Name AS ManagedLocationName
                      FROM $table i
                      LEFT JOIN ManagedLocations ml ON i.ManagedLocationId = ml.Id
                      WHERE i.Quantity > 0";
            // Execute query
            $result = $mysqli->query($query);
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table class='table'>";
                echo "<thead><tr>";
                // Explicitly define table headers
                echo "<th>Name</th>";
                echo "<th>Purpose</th>";
                echo "<th>Description</th>";
                echo "<th>Quantity</th>";
                echo "<th>Managed Location</th>";
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['Name']}</td>";
                    echo "<td>{$row['Purpose']}</td>";
                    echo "<td>{$row['Description']}</td>";
                    echo "<td>{$row['Quantity']}</td>";
                    echo "<td>{$row['ManagedLocationName']}</td>";
                    echo "<td>";
                    echo "<a href='view.php?id=" . $row['Id'] . "' class='btn btn-primary ml-2'>View</a>";
                    echo "<a href='edit.php?id=" . $row['Id'] . "' class='btn btn-primary'>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No out-of-stock data available in $table";
            }
            // Free result set
            $result->free();

            // Close connection
            $mysqli->close();
        ?>
    </div> 
</body>
</html>
