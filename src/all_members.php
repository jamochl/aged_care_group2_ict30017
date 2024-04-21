<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Members</h1>
        <?php
            $table = "Members";
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
                // Add an extra column for actions
                echo "<th>Actions</th>";
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    // Add view and edit buttons with links
                    echo "<td><a href='/members/view.php?id={$row['Id']}' class='btn btn-primary'>View</a> <a href='/members/edit.php?id={$row['Id']}' class='btn btn-primary'>Edit</a></td>";
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
