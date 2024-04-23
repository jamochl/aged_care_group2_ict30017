<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Staff</h1>
        <?php
            $roleCheck = 0;
            $table = "Staff";
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
                    if ($field == $field_names[2]){
                        continue;
                    }

                    if ($field == $field_names[7]){
                        echo "<th>Role</th>";
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
                        if ($value == $row["PasswordHash"] && $roleCheck == 2){
                            $roleCheck += 1;
                            continue;
                        }

                        if ($value == $row["RoleId"] && $roleCheck == 7){
                            $roleCheck = 0;
                            if ($value == 1){
                                echo "<td>Admin</td>";
                            } else if ($value == 2){
                                echo "<td>Staff</td>";
                            } else if ($value == 3){
                                echo "<td>Cleaner</td>";
                            } else if ($value == 4){
                                echo "<td>Accountant</td>";
                            } else {
                                echo "Undefined role";
                            }
                            continue;
                        } else {
                            echo "<td>$value</td>";
                            $roleCheck += 1;
                        }
                    }
                    // Add view and edit buttons with links
                    echo "<td><a href='/staff/view.php?id={$row['Id']}' class='btn btn-primary'>View</a> <a href='/staff/edit.php?id={$row['Id']}' class='btn btn-primary'>Edit</a></td>";
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

        <a href="/staff/add.php" class="btn btn-primary add-button button-gap">Create Staff</a>
    </div>
</body>
</html>