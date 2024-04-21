<?php include '../config.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $passwordHash = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $birthDate = $_POST['birthDate'];

    if ($role == "Admin") {
        $roleID = 1;
    } elseif ($role == "Staff") {
        $roleID = 2;
    } elseif ($role == "Cleaner") {
        $roleID = 3;
    } elseif ($role == "Account") {
        $roleID = 4;
    }
    $sql = "INSERT INTO Staff (Name, PasswordHash, Contact, BirthDate, Nationality, PhoneNumber, RoleId) VALUES ('$name', '$passwordHash', '$email', '$birthDate', '$nationality', '$phone', '$roleID')";
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Create Staff Information</h1>
        <form action="process-employee.php" method="post">
            <label for="name">Name:</label><br>
            <input required type="text" id="name" name="name"><br>
            <label for="password">Password:</label><br>
            <input required type="text" id="password" name="password"><br>
            <label for="email">Email:</label><br>
            <input required type="email" id="email" name="email"><br>
            <label for="role">Role:</label><br>
            <input required type="text" id="role" name="role"><br>
            <label for="phone">Phone Number:</label><br>
            <input required type="text" id="phone" name="phone"><br>
            <label for="nationality">Nationality:</label><br>
            <input required type="text" id="nationality" name="nationality"><br>
            <label for="birthDate">Birth Date:</label><br>
            <input required type="date" id="birthDate" name="birthDate"><br><br>
            <input required type="submit" value="Submit">
        </form>
    </div>
</body>

</html>