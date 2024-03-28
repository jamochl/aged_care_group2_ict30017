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

// Array of tables to select data from
$tables = array("Roles", "Members", "Inventory", "Staff", "Availabilities", "ManagedLocations", "Room", "Utilities", "ServiceRecords", "BillingReports", "BillingItem");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Home page</h1>
        <hr>
        <h2>My Availability</h2>
        <h2>My Upcoming services</h2>
        <!-- Carers should be able to see their current members on the homepage -->
        <?php
        // Consolidated query to fetch data for all services
        $currentDateTime = date("Y-m-d H:i:s");
        $query = "SELECT MemberId, StartTime AS StartDate, EndTime AS EndDate, Id AS ServiceRecordId FROM ServiceRecords";
        $result = $mysqli->query($query);

        // Initialize arrays to store service records data
        $upcomingServices = [];
        $pastServices = [];
        while ($row = $result->fetch_assoc()) {
            if ($row['StartDate'] > $currentDateTime) {
                $upcomingServices[] = $row;
            } else {
                $pastServices[] = $row;
            }
        }

        // Output the data in tables
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<h2>Upcoming Services</h2>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Member ID</th>";
        echo "<th>Start Date</th>";
        echo "<th>End Date</th>";
        echo "<th>Service Record ID</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($upcomingServices as $service) {
            echo "<tr>";
            echo "<td>{$service['MemberId']}</td>";
            echo "<td>{$service['StartDate']}</td>";
            echo "<td>{$service['EndDate']}</td>";
            echo "<td>{$service['ServiceRecordId']}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        ?>
        <h2>My Members</h2>
        <?php
        // Your database connection code goes here

        // Consolidated query to fetch data for all services
        $currentDateTime = date("Y-m-d H:i:s");
        $query = "SELECT MemberId, StartTime AS StartDate, EndTime AS EndDate, Id AS ServiceRecordId FROM ServiceRecords";
        $result = $mysqli->query($query);

        // Initialize arrays to store service records data
        $serviceRecords = [];
        while ($row = $result->fetch_assoc()) {
            $serviceRecords[] = $row;
        }

        // Function to fetch member data from the database
        function fetchMemberData($memberIds)
        {
            global $mysqli;
            $memberData = [];
            foreach ($memberIds as $memberId) {
                $query = "SELECT * FROM Members WHERE Id = $memberId";
                $result = $mysqli->query($query);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $memberData[] = $row;
                }
            }
            return $memberData;
        }

        // Output the data in Bootstrap cards
        echo "<div class='row'>";
        foreach ($serviceRecords as $record) {
            // Fetch member data for the current service record
            $memberData = fetchMemberData([$record['MemberId']]);

            // Display member details card
            echo "<div class='col-md-4 mb-3'>";
            echo "<div class='card'>";
            echo "<div class='card-header'>{$memberData[0]['FirstName']} {$memberData[0]['LastName']}</div>";
            echo "<div class='card-body'>";
            echo "<p class='card-text'>Date of Birth: {$memberData[0]['DateOfBirth']}</p>";
            echo "<p class='card-text'>Contact: {$memberData[0]['Contact']}</p>";
            echo "<p class='card-text'>Family Contact: {$memberData[0]['FamilyContact']}</p>";
            echo "<p class='card-text'>Medical history: {$memberData[0]['MedicalHistory']}</p>";

            // Separate card for upcoming services
            echo "<div class='card mb-3'>";
            echo "<div class='card-header'>Upcoming Services</div>";
            echo "<div class='card-body'>";
            foreach ($serviceRecords as $service) {
                if ($service['StartDate'] > $currentDateTime && $service['MemberId'] == $memberData[0]['Id']) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-header'>Start Date: {$service['StartDate']}</div>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'><strong>End Date:</strong> {$service['EndDate']}</p>";
                    echo "<p class='card-text'><strong>Service Record ID:</strong> {$record['ServiceRecordId']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            echo "</div>";
            echo "</div>";

            // Separate card for past services
            echo "<div class='card'>";
            echo "<div class='card-header'>Past Services</div>";
            echo "<div class='card-body'>";
            foreach ($serviceRecords as $service) {
                if ($service['EndDate'] <= $currentDateTime && $service['MemberId'] == $memberData[0]['Id']) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'><strong>Start Date:</strong> {$service['StartDate']}</p>";
                    echo "<p class='card-text'><strong>End Date:</strong> {$service['EndDate']}</p>";
                    echo "<p class='card-text'><strong>Service Record ID:</strong> {$record['ServiceRecordId']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            echo "</div>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        ?>

        <h2>My Past services</h2>
        <?php
        echo "<div class='col-md-6'>";
        echo "<h2>Past Services</h2>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Member ID</th>";
        echo "<th>Start Date</th>";
        echo "<th>End Date</th>";
        echo "<th>Service Record ID</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($pastServices as $service) {
            echo "<tr>";
            echo "<td>{$service['MemberId']}</td>";
            echo "<td>{$service['StartDate']}</td>";
            echo "<td>{$service['EndDate']}</td>";
            echo "<td>{$service['ServiceRecordId']}</td>";
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