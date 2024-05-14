<?php include '../config.php'; ?>
<?php
// Define variables and initialize with empty values
$name = $password = $birthdate = $gender = $immigrationStatus = $email = $phone = $role = "";
$name_err = $password_err = $birthdate_err = $gender_err = $immigrationStatus_err = $email_err = $phone_err = $role_err = "";

// Fetch roles from the database
$roles_query = "SELECT Id, Name FROM Roles";
$roles_result = $mysqli->query($roles_query);

// Processing form data when form is submitted
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

    // Your database insertion code here...
    $sql = "INSERT INTO Staff (Name, PasswordHash, BirthDate, Gender, ImmigrationStatus, Contact, PhoneNumber, RoleId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssssss", $name, $password, $birthdate, $gender, $immigrationStatus, $email, $phone, $role);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records created successfully. Redirect to landing page
            header("location: /staff/index.php");
            exit();
        } else {
            echo "Failed to create staff data" . $mysqli->error;
            exit();
        }
        // Close statement
        $stmt->close();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h2 class="mb-4">Create Staff Information</h2>
        <form id="add" action="#" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input required type="text" id="name" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input required type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate:</label>
                <input required type="date" id="birthdate" name="birthdate" class="form-control">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select required id="gender" name="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="immigrationStatus" class="form-label">Immigration Status:</label>
                <input required type="text" id="immigrationStatus" name="immigrationStatus" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input required type="email" id="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input required type="text" id="phone" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select required id="role" name="role" class="form-select">
                    <option value="">Select Role</option>
                    <?php
                    // Populate dropdown list with roles
                    while ($row = $roles_result->fetch_assoc()) {
                        echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <input required type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>
