<?php include '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h2>Members</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Medical History</th>
                        <th>Is Still Member</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT Id, FirstName, LastName, DateOfBirth, Gender, PhoneNumber, Email, EmergencyContact, EmergencyRelationship, MedicalHistory, BillingPerYear, IsStillMember FROM Members";
                    if ($result = $mysqli->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['Id'] . "</td>";
                            echo "<td>" . $row['FirstName'] . "</td>";
                            echo "<td>" . $row['LastName'] . "</td>";
                            echo "<td>" . $row['DateOfBirth'] . "</td>";
                            echo "<td>" . $row['Gender'] . "</td>";
                            echo "<td>" . $row['MedicalHistory'] . "</td>";
                            echo "<td>" . ($row['IsStillMember'] == 1 ? "true" : "false") . "</td>";
                            echo "<td>";
                            echo "<a href='view.php?id=" . $row['Id'] . "' class='btn btn-primary ml-2'>View</a>";
                            echo "<a href='edit.php?id=" . $row['Id'] . "' class='btn btn-primary'>Edit</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        $result->free();
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="add.php" class="btn btn-primary">Add New Member</a>
    </div>
</body>
</html>
