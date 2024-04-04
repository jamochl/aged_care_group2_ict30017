<?php
// Database connection details
$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "aged_care";

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) 
{
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Member Data</h1>
        <hr>
        <?php

        //query to retreive all member details
        $sql = "SELECT * FROM members";
        $result = $conn->query($sql);

       echo "<table width='100%' border='1'>";
       echo "<tr><th>Id</th><th>FirstName</th><th>LastName</th><th>DateOfBirth</th><th>Contact</th><th>FamilyContact</th><th>MedicalHistory</th><th>BillingPerYear</th></tr>";
       $row = mysqli_fetch_row($result);
       while ($row) 
       {
           echo "<tr><td>{$row[0]}</td>";
           echo "<td>{$row[1]}</td>";
           echo "<td>{$row[2]}</td>";
           echo "<td>{$row[3]}</td>";
           echo "<td>{$row[4]}</td>";
           echo "<td>{$row[5]}</td>";
           echo "<td>{$row[6]}</td>";
           echo "<td>{$row[7]}</td></tr>";

           $row = mysqli_fetch_row($result);
       }
       echo "</table>";
        
    // Free result set
    $result->free();

    // Close connection
    $mysqli->close();
        ?>
    </div>
</body>
</html>
