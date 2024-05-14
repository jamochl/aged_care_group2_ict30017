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

            $table = "Staff";
            // SQL query to select all data from the table
            $query = "SELECT * FROM $table";
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
                            <th>Staff Name</th>
                            <th>Birth Date</th>
                            <th>Gender</th>
                            <th>Immigration Status</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display the data in the table rows
                        while ($row = $result->fetch_assoc()) {
                            $birthdate = date('Y-m-d', strtotime($row['BirthDate']));
                            // Construct the URL with rosterId as query parameter
                            $url = "/staff/view.php?id=" . $row['Id'];
                            $urlEdit = "/staff/edit.php?id=" . $row['Id'];
                            echo "<tr>";
                            echo "<td>{$row['Id']}</td>";
                            echo "<td>{$row['Name']}</td>";
                            echo "<td>$birthdate</td>";
                            echo "<td>{$row['Gender']}</td>";
                            echo "<td>{$row['ImmigrationStatus']}</td>";
                            echo "<td>{$row['PhoneNumber']}</td>";
                            if ($row['RoleId'] == 1){
                                echo "<td>Admin</td>";
                            } else if ($row['RoleId'] == 2){
                                echo "<td>Carer</td>";
                            } else if ($row['RoleId'] == 3){
                                echo "<td>Cleaner</td>";
                            } else if ($row['RoleId'] == 4){
                                echo "<td>Accountant</td>";
                            }
                            echo "<td><a href='{$url}' class='btn btn-primary add-button'>View</a><a href='{$urlEdit}' class='btn btn-primary add-button'>Edit</a></td>";
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

        <a href="/staff/add.php" class="btn btn-primary add-button button-gap">Create Staff</a>
    </div>
</body>
</html>