<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new member</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add new member</h1>
        <hr>
<body>

    <form action=AddMember.php method="POST">
        
        <label class="label" for="memberId"> Member ID: &nbsp;&nbsp; </label>
        <input type="text" name="memberId" id="memberId"> <br><br>

        <label class="label" for="fname"> First Name: &nbsp;&nbsp; </label>
        <input type="text" name="fname" id="fname"> <br><br>

        <label class="label" for="lname"> Last Name: &nbsp;</label>
        <input type="text" name="lname" id="lname"> <br><br>

        <label class="label" for="dob"> Date of Birth: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="dob" id="dob"> <br><br>

        <label class="label" for="contact"> Contact: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="contact" id="contact"> <br><br>

        <label class="label" for="fcontact"> Family Contact: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="fcontact" id="fcontact"> <br><br>

        <label class="label" for="medhistory"> Medical History: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="medhistory" id="medhistory"> <br><br>

        <label class="label" for="bpy"> Billing Per Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="bpy" id="bpy"> <br><br>

        <input class="button" type="submit" name="submit" value="submit">
    </form>
</body>

</html>

<?php

if(isset($_POST["submit"]))
{
// Database connection details
$host = "db";
$port = "3306";
$user = "admin";
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
    // ## 2. set up SQL string and execute

    $memberId = $_POST["memberId"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];
    $fcontact = $_POST["fcontact"];
    $medhistory = $_POST["medhistory"];
    $bpy = $_POST["bpy"];

    $query = "INSERT INTO Members (Id, FirstName, LastName, DateOfBirth, Contact, FamilyContact, MedicalHistory, BillingPerYear) VALUES
    ('$memberId', '$fname', '$lname', '$dob', '$contact', '$fcontact', '$medhistory','$bpy')";

    $mysqli->query($query);
    mysqli_close($mysqli);

    
}
    ?>