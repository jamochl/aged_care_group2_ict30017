<?php
// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Define variables and initialize with empty values
$firstName = $lastName = $dateOfBirth = $contact = $familyContact = $medicalHistory = $billingPerYear = "";

// Check if the 'id' key is set in the $_GET superglobal array
if(isset($_GET["id"])) {
    // Prepare a select statement
    $sql = "SELECT * FROM Members WHERE Id = ?";
    
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
                $contact = $row["Contact"];
                $familyContact = $row["FamilyContact"];
                $medicalHistory = $row["MedicalHistory"];
                $billingPerYear = $row["BillingPerYear"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else {
    // If 'id' key is not set, redirect to error page
    header("location: error.php");
    exit();
}
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
        <h2>View Member</h2>
        <form>
            <div class="form-group mb-3">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" disabled>
            </div>
            <div class="form-group mb-3">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" disabled>
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dateOfBirth" class="form-control" value="<?php echo $dateOfBirth; ?>" disabled>
            </div>
            <div class="form-group mb-3">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>" disabled>
            </div>
            <div class="form-group mb-3">
                <label>Family Contact</label>
                <input type="text" name="familyContact" class="form-control" value="<?php echo $familyContact; ?>" disabled>
            </div>
            <div class="form-group mb-3">
                <label>Medical History</label>
                <textarea name="medicalHistory" class="form-control" disabled><?php echo $medicalHistory; ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label>Billing Per Year</label>
                <input type="text" name="billingPerYear" class="form-control" value="<?php echo $billingPerYear; ?>" disabled>
            </div>
            <a href="edit_member.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-primary">Edit Member</a>
        </form>
    </div>
</body>
</html>
