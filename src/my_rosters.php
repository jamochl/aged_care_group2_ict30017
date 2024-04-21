<?php

    // Start session to access the user
    session_start();

    // Checks that user is logged in and is an admin
    if (!isset($_SESSION["role"]) || $_SESSION["role"] != 2) {
        // If not logged in then redirect back to login
        header("Location: index.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
        // Unset all sessions variables
        $_SESSION = array();

        // Destroy session
        session_destroy();

        // Redirect to the login page 
        header("Location: index.php");
        exit;
    }

    // Get the staff ID from the query string
    $staffId = isset($_GET['staffid']) ? intval($_GET['staffid']) : 1;

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosters</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Rosters</h1>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Service Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Managed Location</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to fetch rosters
                        $query = "SELECT r.*, s.Name AS StaffName, ml.Name AS ManagedLocationName 
                                FROM Rosters r
                                INNER JOIN Staff s ON r.StaffId = s.Id
                                INNER JOIN ManagedLocations ml ON r.ManagedLocationId = ml.Id WHERE r.StaffId = $staffId";
                        $result = $mysqli->query($query);

                        // Display the data in the table rows
                        while ($row = $result->fetch_assoc()) {
                            // Construct the URL with rosterId as query parameter
                            $url = "my_services.php?rosterid=" . $row['Id'];
                            echo "<tr class='table-active' onclick='window.location.href=\"$url\"' style='cursor:pointer;'>";
                            echo "<td>{$row['StaffName']}</td>";
                            echo "<td>{$row['ServiceType']}</td>";
                            echo "<td>{$row['StartTime']}</td>";
                            echo "<td>{$row['EndTime']}</td>";
                            echo "<td>{$row['ManagedLocationName']}</td>";
                            echo "<td>{$row['Notes']}</td>";
                            echo "</tr>";
                        }

                        // Close database connection
                        $mysqli->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>