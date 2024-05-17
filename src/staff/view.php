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
            $birthdate = date('Y-m-d', strtotime($row['BirthDate']));
            $gender = $row["Gender"];
            $immigrationStatus = $row["ImmigrationStatus"];
            $email = $row["Contact"];
            $phoneNumber = $row["PhoneNumber"];
            if ($row['RoleId'] == 1){
                $role = 'Admin';
            } else if ($row['RoleId'] == 2){
                $role = 'Carer';
            } else if ($row['RoleId'] == 3){
                $role = 'Cleaner';
            } else if ($row['RoleId'] == 4){
                $role = 'Accountant';
            }
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
    <title>View Staff</title>
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
        <h2>View Staff</h2>
        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <label>Name</label>
                <input disabled type="text" name="Name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input disabled type="date" name="birthDate" class="form-control" value="<?php echo $birthdate; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Gender</label>
                <input disabled type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Phone Number</label>
                <input disabled type="text" name="phoneNumber" class="form-control" value="<?php echo $phoneNumber; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input disabled type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Immigration Status</label>
                <input disabled type="text" name="immigrationStatus" class="form-control" value="<?php echo $immigrationStatus; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Role</label>
                <input disabled type="text" name="role" class="form-control" value="<?php echo $role; ?>">
            </div>
            <a href="/staff/edit.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-primary">Edit Staff</a>
        </form>
    </div>
</body>
</html>
