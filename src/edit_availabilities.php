<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availabilities</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px; /* Add margin to create space between tables and edges of the page */
        }
        table {
            width: calc(100% - 40px); /* Adjust the width to leave a gap on both sides */
            border-collapse: collapse;
            margin: 0 auto; /* Center the tables horizontally */
            margin-bottom: 20px; /* Add some bottom margin for spacing between tables */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .update-button, .delete-button {
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .section-divider {
            width: 100%;
            border-top: 2px solid #ccc;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .top-right-button {
            position: absolute;
            top: 20px;
            right: 20px;
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

    // Table names
    $availabilitiesTable = "Availabilities";
    $staffTable = "Staff";

    // SQL query to retrieve availabilities with staff names
    $availabilitiesQuery = "SELECT Availabilities.Id, Availabilities.StartTime, Availabilities.EndTime, Availabilities.StaffId, Staff.Name AS StaffName FROM $availabilitiesTable JOIN $staffTable ON Availabilities.StaffId = Staff.Id";

    // Execute the availabilities query
    $availabilitiesResult = $mysqli->query($availabilitiesQuery);

    echo "<h2>Availabilities</h2>";
    // Display availabilities with staff names in a table
    if ($availabilitiesResult->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr>";
        echo "<th>Start Time</th>";
        echo "<th>End Time</th>";
        echo "<th>Staff Name</th>";
        echo "<th>Actions</th>";
        echo "</tr></thead><tbody>";
        while ($row = $availabilitiesResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['StartTime']}</td>";
            echo "<td>{$row['EndTime']}</td>";
            echo "<td>{$row['StaffName']}</td>";
            echo "<td>";
            echo "<a href='availability_handler.php?action=update&id={$row['Id']}' class='btn btn-primary update-button'>Update</a>";
            echo "<form style='display: inline;' method='POST' action='availability_handler.php'>";
            echo "<input type='hidden' name='availability_id' value='{$row['Id']}'>";
            echo "<input type='hidden' name='action' value='delete'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No data available in $availabilitiesTable";
    }
    $availabilitiesResult->free();
    
    // Close connection
    $mysqli->close();
    ?>

    <!-- Button to redirect to roster.php -->
    <div class="container mt-3">
        <a href="roster.php" class="btn btn-secondary top-right-button">Go to Roster</a>
    </div>

</body>
</html>
