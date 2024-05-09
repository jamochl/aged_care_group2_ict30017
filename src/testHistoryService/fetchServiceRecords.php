<?php
$servername = "db";
$username = "admin";
$password = "admin";
$dbname = "aged_care";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ServiceRecords";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<p>" . $row["Id"] . " - " . $row["ServiceType"] . "</p>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
