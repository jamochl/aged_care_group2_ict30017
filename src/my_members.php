<?php
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
    <title>Database Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>My Members</h1>

        <?php
        // Your database connection code goes here
        $currentDateTime = date("Y-m-d H:i:s");

        // Query to fetch data for all services and related member details
        $query = "SELECT s.MemberId, s.StartTime AS StartDate, s.EndTime AS EndDate, s.Id AS ServiceRecordId, m.FirstName, m.LastName, m.MedicalHistory, m.Contact, m.FamilyContact FROM ServiceRecords s INNER JOIN Members m ON s.MemberId = m.Id";
        $result = $mysqli->query($query);

        echo "<div class='row'>";
        echo "<div class='col-md-12'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Member Name</th>";
        echo "<th>Medical History</th>";
        echo "<th>Contact</th>";
        echo "<th>Family Contact</th>";
        echo "<th>Service Details</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['FirstName']} {$row['LastName']}</td>";
            echo "<td>{$row['MedicalHistory']}</td>";
            echo "<td>{$row['Contact']}</td>";
            echo "<td>{$row['FamilyContact']}</td>";
            echo "<td>";
            echo "Start Date: {$row['StartDate']}<br>";
            echo "End Date: {$row['EndDate']}<br>";
            echo "Service Record ID: {$row['ServiceRecordId']}<br>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        ?>

    </div>
</body>

</html>

<?php
// Close database connection
$mysqli->close();
?>
