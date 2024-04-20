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
<html>
<head>
    <title>Roster View</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
</head>
<body>

<h1>All rosters</h1>

<div id='calendar'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'listYear',
            events: [
                // PHP code to fetch past and upcoming rosters
                <?php
                // Query to get past and upcoming rosters from ServiceRecords table
                $sql = "SELECT sr.Id, sr.StartTime, sr.EndTime, sr.ServiceType, s.Name AS StaffName, m.FirstName AS MemberFirstName, m.LastName AS MemberLastName FROM ServiceRecords sr 
                        LEFT JOIN Staff s ON sr.StaffId = s.Id 
                        LEFT JOIN Members m ON sr.MemberId = m.Id";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $title = $row["ServiceType"] . " - " . $row["StaffName"] . " - " . $row["MemberFirstName"] . " " . $row["MemberLastName"];
                        echo "{";
                        echo "interactable: true,";
                        echo "title: '" . $title . "',";
                        echo "start: '" . $row["StartTime"] . "',";
                        echo "end: '" . $row["EndTime"] . "'";
                        echo "},";
                    }
                }

                $result->close();
                ?>
            ]
        });

        calendar.render();
    });
</script>

</body>
</html>
