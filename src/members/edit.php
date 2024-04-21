<?php include '../config.php'; ?>

<?php
// Define variables and initialize with empty values
$firstName = $lastName = $dateOfBirth = $contact = $familyContact = $medicalHistory = $billingPerYear = "";
$firstName_err = $lastName_err = $dateOfBirth_err = $contact_err = $familyContact_err = $medicalHistory_err = $billingPerYear_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate first name
    $input_firstName = trim($_POST["firstName"]);
    if(empty($input_firstName)){
        $firstName_err = "Please enter a first name.";
    } else{
        $firstName = $input_firstName;
    }

    // Validate last name
    $input_lastName = trim($_POST["lastName"]);
    if(empty($input_lastName)){
        $lastName_err = "Please enter a last name.";
    } else{
        $lastName = $input_lastName;
    }

    // Validate date of birth
    $input_dateOfBirth = trim($_POST["dateOfBirth"]);
    if(empty($input_dateOfBirth)){
        $dateOfBirth_err = "Please enter a date of birth.";
    } else{
        $dateOfBirth = $input_dateOfBirth;
    }

    // Validate contact
    $input_contact = trim($_POST["contact"]);
    if(empty($input_contact)){
        $contact_err = "Please enter a contact number.";
    } else{
        $contact = $input_contact;
    }

    // Validate family contact
    $input_familyContact = trim($_POST["familyContact"]);
    if(empty($input_familyContact)){
        $familyContact_err = "Please enter a family contact number.";
    } else{
        $familyContact = $input_familyContact;
    }

    // Validate medical history
    $input_medicalHistory = trim($_POST["medicalHistory"]);
    if(empty($input_medicalHistory)){
        $medicalHistory_err = "Please enter medical history.";
    } else{
        $medicalHistory = $input_medicalHistory;
    }

    // Validate billing per year
    $input_billingPerYear = trim($_POST["billingPerYear"]);
    if(empty($input_billingPerYear)){
        $billingPerYear_err = "Please enter billing per year.";
    } else{
        $billingPerYear = $input_billingPerYear;
    }

    // Check input errors before updating the database
    if(empty($firstName_err) && empty($lastName_err) && empty($dateOfBirth_err) && empty($contact_err) && empty($familyContact_err) && empty($medicalHistory_err) && empty($billingPerYear_err)){
        // Prepare an update statement
        $sql = "UPDATE Members SET FirstName=?, LastName=?, DateOfBirth=?, Contact=?, FamilyContact=?, MedicalHistory=?, BillingPerYear=? WHERE Id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssdi", $param_firstName, $param_lastName, $param_dateOfBirth, $param_contact, $param_familyContact, $param_medicalHistory, $param_billingPerYear, $param_id);

            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_dateOfBirth = $dateOfBirth;
            $param_contact = $contact;
            $param_familyContact = $familyContact;
            $param_medicalHistory = $medicalHistory;
            $param_billingPerYear = $billingPerYear;
            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: /members/my.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else{
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
                header("location: /error.php");
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
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
        <h2>Edit Member</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <label>First Name</label>
                <input required type="text" name="firstName" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Last Name</label>
                <input required type="text" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input required type="datetime-local" name="dateOfBirth" class="form-control <?php echo (!empty($dateOfBirth_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($dateOfBirth); ?>">
                <span class="invalid-feedback"><?php echo $dateOfBirth_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Contact</label>
                <input required type="text" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
                <span class="invalid-feedback"><?php echo $contact_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Family Contact</label>
                <input required type="text" name="familyContact" class="form-control <?php echo (!empty($familyContact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $familyContact; ?>">
                <span class="invalid-feedback"><?php echo $familyContact_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Medical History</label>
                <textarea name="medicalHistory" class="form-control <?php echo (!empty($medicalHistory_err)) ? 'is-invalid' : ''; ?>"><?php echo $medicalHistory; ?></textarea>
                <span class="invalid-feedback"><?php echo $medicalHistory_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Billing Per Year</label>
                <input required type="text" name="billingPerYear" class="form-control <?php echo (!empty($billingPerYear_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $billingPerYear; ?>">
                <span class="invalid-feedback"><?php echo $billingPerYear_err; ?></span>
            </div>
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
            <input required type="submit" class="btn btn-primary" value="Submit">
            <a href="my_members.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>
