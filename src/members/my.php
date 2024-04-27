<?php include '../config.php'; ?>

<?php
$staffId = isset($_SESSION['staffid']) ? intval($_SESSION['staffid']) : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Members</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>My Members</h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Medical History</th>
                            <th>Phone Number</th>
                            <th>Emergency contact details</th>
                            <th>Emergency contact relationship </th>
                            <th>Service Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Your database connection code goes here
                        $currentDateTime = date("Y-m-d H:i:s");

                        // Query to fetch data for all services and related member details
                        $query = "SELECT s.MemberId, s.StartTime AS StartDate, s.EndTime AS EndDate, s.Id AS ServiceRecordId, m.FirstName, m.LastName, m.MedicalHistory, m.PhoneNumber, m.EmergencyContact, m.EmergencyRelationship, m.Gender FROM ServiceRecords s
                            INNER JOIN Members m ON s.MemberId = m.Id
                            WHERE s.StaffId = {$staffId}";
                        $result = $mysqli->query($query);

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['FirstName']} {$row['LastName']}</td>";
                            echo "<td>{$row['MedicalHistory']}</td>";
                            echo "<td>{$row['PhoneNumber']}</td>";
                            echo "<td>{$row['EmergencyContact']}</td>";
                            echo "<td>{$row['EmergencyRelationship']}</td>";
                            echo "<td>";
                            echo "Start Date: {$row['StartDate']}<br>";
                            echo "End Date: {$row['EndDate']}<br>";
                            echo "Service Record ID: {$row['ServiceRecordId']}<br>";
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='/members/view.php?id={$row['MemberId']}' class='btn btn-primary'>View</a>";
                            echo "<a href='/members/edit.php?id={$row['MemberId']}' class='btn btn-secondary'>Edit</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close database connection
$mysqli->close();
?>
