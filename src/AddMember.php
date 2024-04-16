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
        <textarea name="medhistory" id="medhistory" maxlength="260" width="300px" style="width: 300px; height: 100px;"></textarea> <br><br>

        <label class="label" for="bpy"> Billing Per Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" name="bpy" id="bpy"> <br><br>

        <input class="button" type="submit" name="submit" value="submit">
    </form>
</body>

</html>

<?php

$pattern1 = "/[0-9]*$/"; //validation pattern for only numbers
$pattern2 = "/[a-zA-Z]*$/"; // validation pattern for only alphanumerics
$pattern3 = "/[\w]+(@)[a-zA-Z]+?(\.[a-zA-Z]+)+/"; // validation pattern for email 

if(isset($_POST["submit"]))
{

$checkerror = 0;    
$memberId = $_POST["memberId"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$dob = $_POST["dob"];
$contact = $_POST["contact"];
$fcontact = $_POST["fcontact"];
$medhistory = $_POST["medhistory"];
$bpy = $_POST["bpy"];

//id validation
if(empty($memberId))
{
    echo "Member ID cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern1, $memberId) == "false")
{
    echo "Member ID can only contain digits between 0-9.<br>";
    $checkerror = $checkerror +1;
}

//first name validation
if(empty($fname))
{
    echo "First name cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern2, $fname) == "false")
{
    echo "First can only contain alphanumeric characters.<br>";
    $checkerror = $checkerror +1;
}

//last name validation
if(empty($lname))
{
    echo "Last name cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern1, $lname) == "false")
{
    echo "Last name can only contain alphanumeric characters.<br>";
    $checkerror = $checkerror +1;
}

//date of birth validation
if(empty($dob))
{
    echo "Date of birth cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern3, $dob) == "false")
{
    echo "Date must be in dd/mm/yy format.<br>";
    $checkerror = $checkerror +1;
}

//contact validation
if(empty($contact))
{
    echo "Contact email cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern3, $contact) == "false")
{
    echo "email must be in name123@example.com format.<br>";
    $checkerror = $checkerror +1;
}

//fcontact validation
if(empty($fcontact))
{
    echo "family Contact cannot be empty.<br>";
    $checkerror = $checkerror +1;
}
elseif(preg_match($pattern3, $fcontact) == "false")
{
    echo "email must be in name123@example.com format.<br>";
    $checkerror = $checkerror +1;
}

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



    $query = "INSERT INTO Members (Id, FirstName, LastName, DateOfBirth, Contact, FamilyContact, MedicalHistory, BillingPerYear) VALUES
    ('$memberId', '$fname', '$lname', '$dob', '$contact', '$fcontact', '$medhistory','$bpy')";

    $mysqli->query($query);
    mysqli_close($mysqli);

    
}
    ?>