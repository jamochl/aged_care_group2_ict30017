<?php include '../config.php'; ?>
<?php
// Define variables and initialize with empty values

// Prepare a select statement
$sql = "SELECT * FROM Staff WHERE Id = ?";
if($stmt = $mysqli->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);
    
    // Set parameters
    $param_id = $_GET["id"];
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
            $row = $result->fetch_array(MYSQLI_ASSOC);
            
            // Retrieve individual field value
            $id = $row["Id"];
            $name = $row["Name"];
            $password = $row["PasswordHash"];
            $birthdate = date('Y-m-d', strtotime($row['BirthDate']));
            $gender = $row["Gender"];
            $immigrationStatus = $row["ImmigrationStatus"];
            $email = $row["Contact"];
            $phoneNumber = $row["PhoneNumber"];
            $role = $row["RoleId"];
        } else{
            // URL doesn't contain valid id parameter. Redirect to error page
            header("location: /error.php");
            exit();
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}

// Close statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper{
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper p-3">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h2>View Member</h2>
        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Phone Number</label>
                <input type="text" name="phoneNumber" class="form-control" value="<?php echo $phoneNumber; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Immigration Status</label>
                <input type="text" name="immigrationStatus" class="form-control" value="<?php echo $immigrationStatus; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Role</label>
                <input type="text" name="role" class="form-control" value="<?php echo $role; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Update Staff</button>
        </form>
    </div>

    <?php
    if ($_POST){
        $name = $_POST["name"];
        $password = $_POST["password"];
        $birthdate = $_POST["birthdate"];
        $gender = $_POST["gender"];
        $immigrationStatus = $_POST["immigrationStatus"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $role = $_POST["role"];
        // SQL query to update staff details
        $query = "UPDATE Staff SET Name='$name', PasswordHash='$password', BirthDate='$birthdate', Gender = '$gender', ImmigrationStatus = '$immigrationStatus', Contact='$email', PhoneNumber='$phoneNumber', RoleId='$role' WHERE Id='$id'";
        $mysqli->query($query);
    } 
    ?>
</body>

</html>
