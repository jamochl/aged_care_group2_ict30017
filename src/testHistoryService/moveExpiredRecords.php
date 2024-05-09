<?php
// Database connection
$servername = "db";
$username = "admin";
$password = "admin";
$dbname = "aged_care";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Move expired records to serviceHistory table
$sql = "INSERT INTO serviceHistory SELECT * FROM ServiceRecords WHERE EndTime < NOW()";
if ($conn->query($sql) === TRUE) {
    echo "Expired records moved to serviceHistory successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
