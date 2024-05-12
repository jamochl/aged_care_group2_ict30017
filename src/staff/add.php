<?php include '../config.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $immigrationStatus = $_POST["immigrationStatus"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $role = $_POST["role"];


    $sql = "INSERT INTO Staff (Name, PasswordHash, BirthDate, Gender, ImmigrationStatus, Contact, PhoneNumber, RoleId) VALUES ('$name', '$password', '$birthdate', '$gender', '$immigrationStatus', '$email', '$phone', '$role')";
    if ($mysqli->query($sql) === true) {
        echo "New employee created successfully";
    } else {
        echo "Failed to collect data from MySQL: " . $mysqli->connect_error;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Staff Info</title>

    <link href="modal.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="validating.js"></script>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Create Staff Information</h1>
        <form id="add" action="#" method="post">
            <label for="name">Name:</label><br>
            <input required type="text" id="name" name="name"><br>
            <label for="password">Password:</label><br>
            <input required type="password" id="password" name="password"><br>
            <label for="repassword">Retype Password:</label><br>
            <input required type="password" id="repassword" name="repassword"><br>
            <label for="name">Gender:</label><br>
            <input required type="text" id="gender" name="gender"><br>
            <label for="email">Email:</label><br>
            <input required type="email" id="email" name="email"><br>
            <label for="roleID">Role ID:</label><br>
            <input required type="number" id="role" name="role"><br>
            <label for="phone">Phone Number:</label><br>
            <input required type="text" id="phone" name="phone"><br>
            <label for="nationality">Immigration Status:</label><br>
            <input required type="text" id="immigrationStatus" name="immigrationStatus"><br>
            <label for="birthDate">Birth Date:</label><br>
            <input required type="date" id="birthdate" name="birthdate"><br><br>
            <input required type="submit" value="Submit">
        </form>
    </div>
</body>

</html>