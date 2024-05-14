<?php include '../config.php'; ?>
<?php
// Define variables and initialize with empty values
$firstName = $lastName = $dateOfBirth = $gender = $phoneNumber = $email = $emergencyContact = $emergencyRelationship = $medicalHistory = $billingPerYear = "";
$firstName_err = $lastName_err = $dateOfBirth_err = $gender_err = $phoneNumber_err = $email_err = $emergencyContact_err = $emergencyRelationship_err = $medicalHistory_err = $billingPerYear_err = "";

// Prepare a select statement
$sql = "SELECT Id, FirstName, LastName, DateOfBirth, Gender, PhoneNumber, Email, EmergencyContact, EmergencyRelationship, MedicalHistory, BillingPerYear FROM Members WHERE Id = ?";
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
            $firstName = $row["FirstName"];
            $lastName = $row["LastName"];
            $dateOfBirth = $row["DateOfBirth"];
            $gender = $row["Gender"];
            $phoneNumber = $row["PhoneNumber"];
            $email = $row["Email"];
            $emergencyContact = $row["EmergencyContact"];
            $emergencyRelationship = $row["EmergencyRelationship"];
            $medicalHistory = $row["MedicalHistory"];
            $billingPerYear = $row["BillingPerYear"];
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
                <label>First Name</label>
                <input disabled type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Last Name</label>
                <input disabled type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input disabled type="date" name="dateOfBirth" class="form-control" value="<?php echo $dateOfBirth; ?>">
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
                <label>Emergency Contact</label>
                <input disabled type="text" name="emergencyContact" class="form-control" value="<?php echo $emergencyContact; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Emergency Relationship</label>
                <input disabled type="text" name="emergencyRelationship" class="form-control" value="<?php echo $emergencyRelationship; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Medical History</label>
                <textarea disabled name="medicalHistory" class="form-control"><?php echo $medicalHistory; ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label>Billing Per Year</label>
                <input disabled type="text" name="billingPerYear" class="form-control" value="<?php echo $billingPerYear; ?>">
            </div>
            <a href="edit.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-primary">Edit Member</a>
        </form>
    </div>
</body>
</html>
