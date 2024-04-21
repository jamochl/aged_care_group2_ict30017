<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Records and Availabilities</title>
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
        .add-button, .update-button {
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .add-form, .update-form {
            display: none;
        }
        .section-divider {
            width: 100%;
            border-top: 2px solid #ccc;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .button-gap {
            margin-right: 10px;
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
    $serviceRecordsTable = "ServiceRecords";
    $availabilitiesTable = "Availabilities";
    $staffTable = "Staff";

    // SQL query to retrieve service records with staff names, managed location, and notes
    $serviceRecordsQuery = "SELECT ServiceRecords.Id, Staff.Name AS StaffName, ServiceRecords.ServiceType, ServiceRecords.StartTime, ServiceRecords.EndTime, ManagedLocations.Name AS ManagedLocation, ServiceRecords.Notes FROM $serviceRecordsTable INNER JOIN $staffTable ON ServiceRecords.StaffId = Staff.Id LEFT JOIN ManagedLocations ON ServiceRecords.ManagedLocationId = ManagedLocations.Id";

    // Execute the service records query
    $serviceRecordsResult = $mysqli->query($serviceRecordsQuery);

    echo "<h2>$serviceRecordsTable</h2>";
    // Display service records in a table
    if ($serviceRecordsResult->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr>";
        echo "<th>Staff Name</th>";
        echo "<th>Service Type</th>";
        echo "<th>Start Time</th>";
        echo "<th>End Time</th>";
        echo "<th>Managed Location</th>";
        echo "<th>Notes</th>";
        echo "</tr></thead><tbody>";
        while ($row = $serviceRecordsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['StaffName']}</td>";
            echo "<td>{$row['ServiceType']}</td>";
            echo "<td>{$row['StartTime']}</td>";
            echo "<td>{$row['EndTime']}</td>";
            echo "<td>{$row['ManagedLocation']}</td>";
            echo "<td>{$row['Notes']}</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No data available in $serviceRecordsTable";
    }
    $serviceRecordsResult->free();

    // Button to add a new service record
    echo "<button onclick=\"window.location.href='add_record.php'\" class=\"btn btn-primary add-button\">Add new service record</button>";
    echo "<button onclick=\"window.location.href='update_record.php'\" class=\"btn btn-primary add-button\">Edit existing service record</button>";

    // Section divider between Service Records and Availabilities
    echo "<div class='section-divider'></div>";

    // SQL query to retrieve availabilities with staff names
    $availabilitiesQuery = "SELECT Availabilities.Id, Availabilities.StartTime, Availabilities.EndTime, Availabilities.StaffId, Staff.Name AS StaffName FROM $availabilitiesTable JOIN $staffTable ON Availabilities.StaffId = Staff.Id";

    // Execute the availabilities query
    $availabilitiesResult = $mysqli->query($availabilitiesQuery);

    echo "<h2>$availabilitiesTable</h2>";
    // Display availabilities with staff names in a table
    if ($availabilitiesResult->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr>";
        echo "<th>Staff ID</th>";
        echo "<th>Staff Name</th>";
        echo "<th>Start Time</th>";
        echo "<th>End Time</th>";
        echo "</tr></thead><tbody>";
        while ($row = $availabilitiesResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['StaffId']}</td>";
            echo "<td>{$row['StaffName']}</td>";
            echo "<td>{$row['StartTime']}</td>";
            echo "<td>{$row['EndTime']}</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No data available in $availabilitiesTable";
    }
    $availabilitiesResult->free();
    
    // Button to add a new availability
    echo "<button onclick=\"window.location.href='add_availability.php'\" class=\"btn btn-primary add-button button-gap\">Add Availability</button>";
    echo "<button onclick=\"window.location.href='edit_availabilities.php'\" class=\"btn btn-primary add-button\">Edit Availabilities</button>";

    // Close connection
    $mysqli->close();
    ?>

</body>
</html>
