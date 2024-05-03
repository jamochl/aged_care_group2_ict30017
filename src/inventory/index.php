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
        <h1>Out Of Stock Data</h1>
        <hr>
        <?php
            $table = "Inventory";
            echo "<h2>$table</h2>";
            // SQL query to select all data from the table
            $query = "SELECT * FROM $table Where Quantity = '0' ";
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

        // Close connection
        $mysqli->close();
        ?>
    </div> 
</body>
</html>
