<?php
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

// Array of tables to select data from
$tables = array("Roles", "Members", "Inventory", "Staff", "Availabilities", "ManagedLocations", "Room", "Utilities", "Rosters", "ServiceRecords", "BillingReports", "BillingItem");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            &gt; <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Database Data</h1>
        <hr>
        <?php
        // Loop through tables and select data
        foreach ($tables as $table) {
            echo "<h2>$table</h2>";
            // SQL query to select all data from the table
            $query = "SELECT * FROM $table";
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
                    echo "<th>$field->name</th>";
                }
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No data available in $table";
            }
            // Free result set
            $result->free();
        }

        // Close connection
        $mysqli->close();
        ?>
    </div>
</body>
</html>
