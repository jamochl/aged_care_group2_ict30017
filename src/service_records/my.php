<?php include '../config.php'; ?>
<?php
// Get the roster ID from the query string
$rosterId = isset($_GET['rosterid']) ? intval($_GET['rosterid']) : null;
$staffId = isset($_SESSION['staffid']) ? intval($_SESSION['staffid']) : null;

// Define roleId variable and initialize with null
$roleId = null;

// Get the roleId from the session or database query result
if (isset($_SESSION['roleid'])) {
    $roleId = intval($_SESSION['roleid']);
} elseif ($staffId !== null) {
    // Query to fetch the roleId based on the staffId
    $query = "SELECT RoleId FROM Staff WHERE Id = ?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $staffId);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $roleId = intval($row['RoleId']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Service Records</h1>
        <?php
        // Query to fetch service records related to a specific roster
        if ($rosterId != null) {
            $query = "SELECT sr.*, r.ServiceType, r.StartTime AS RosterStartTime, r.EndTime AS RosterEndTime, ml.Name AS ManagedLocationName, s.Name AS StaffName, m.FirstName AS MemberFirstName, m.LastName AS MemberLastName, sr.Progress, st.RoleId
                    FROM ServiceRecords sr
                    INNER JOIN Rosters r ON sr.RosterId = r.Id
                    INNER JOIN Staff s ON r.StaffId = s.Id
                    INNER JOIN Members m ON sr.MemberId = m.Id
                    INNER JOIN ManagedLocations ml ON sr.ManagedLocationId = ml.Id
                    INNER JOIN Staff st ON sr.StaffId = st.Id
                    WHERE r.Id = ? AND
                    s.Id = ?";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("ii", $rosterId, $staffId);
            $statement->execute();
            $result = $statement->get_result();
        } else {
            $query = "SELECT sr.*, r.ServiceType, r.StartTime AS RosterStartTime, r.EndTime AS RosterEndTime, ml.Name AS ManagedLocationName, s.Name AS StaffName, m.FirstName AS MemberFirstName, m.LastName AS MemberLastName, sr.Progress, st.RoleId
                    FROM ServiceRecords sr
                    INNER JOIN Rosters r ON sr.RosterId = r.Id
                    INNER JOIN Staff s ON r.StaffId = s.Id
                    INNER JOIN Members m ON sr.MemberId = m.Id
                    INNER JOIN ManagedLocations ml ON sr.ManagedLocationId = ml.Id 
                    INNER JOIN Staff st ON sr.StaffId = st.Id
                    WHERE s.Id = ?";
            $statement = $mysqli->prepare($query);
            $statement->bind_param("i", $staffId);
            $statement->execute();
            $result = $statement->get_result();
        }

        if ($result->num_rows > 0) {
        ?>
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <?php if ($roleId != 3 && $roleId != 4) { ?>
                                    <th>Member</th>
                                <?php } ?>
                                <th>Service Type</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Managed Location</th>
                                <th>Notes</th>
                                <?php if ($roleId == 3) { ?>
                                    <th>Progress</th>
                                <?php } ?>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Display the data in the table rows
                            while ($row = $result->fetch_assoc()) {
                                // Construct the URL with serviceId as query parameter
                                $url = "/service_records/view.php?id=" . $row['Id'];
                                $urlEdit = "/service_records/edit.php?id=" . $row['Id'];
                                echo "<tr>";
                                echo "<td>{$row['StaffName']}</td>";
                                if ($roleId != 3 && $roleId != 4) {
                                    echo "<td>{$row['MemberFirstName']} {$row['MemberLastName']}</td>";
                                }
                                echo "<td>{$row['ServiceType']}</td>";
                                echo "<td>{$row['StartTime']}</td>";
                                echo "<td>{$row['EndTime']}</td>";
                                echo "<td>{$row['ManagedLocationName']}</td>";
                                echo "<td>{$row['Notes']}</td>";
                                if ($roleId == 3) {
                                    // Check the value of Progress and display corresponding text
                                    $progressText = $row['Progress'] == 1 ? 'Completed' : 'Not Completed';
                                    echo "<td>{$progressText}</td>";
                                }
                                echo "<td><a href='{$url}' class='mx-2 btn btn-primary add-button'>View Record</a>";

                                // Redirect to "/cleaner/status.php" if RoleId is 3
                                if ($row['RoleId'] == 3) {
                                    echo "<a href='/cleaner/edit.php?id={$row['Id']}' class='btn btn-primary add-button'>Edit Status</a>";
                                } 
                                // Disable the "Edit Record" button if RoleId is 4
                                elseif ($row['RoleId'] == 4) {
                                    echo "<span class='btn btn-primary add-button disabled' aria-disabled>Edit Record</span>";
                                } 
                                // Render an active "Edit Record" button for other RoleIds
                                else {
                                    echo "<a href='{$urlEdit}' class='btn btn-primary add-button'>Edit Record</a>";
                                }

                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
            echo "<p>No service history for this roster or staff</p>";
        }
        ?>

        

    </div>
</body>

</html>
