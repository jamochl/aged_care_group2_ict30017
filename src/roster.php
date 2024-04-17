<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .add-button, .update-button {
            margin-bottom: 10px;
        }
        .add-form, .update-form {
            display: none;
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

    $table = "ServiceRecords";
    // SQL query to retrieve service records
    $query = "SELECT * FROM $table";

    // Execute query
    $result = $mysqli->query($query);

    echo "<h2>$table</h2>";
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

    

 
    
</body>
</html>
