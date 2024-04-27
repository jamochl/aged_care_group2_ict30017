<?php include '../config.php'; ?>
<?php
// Define variables and initialize with empty values
$firstName = $lastName = $dateOfBirth = $gender = $phoneNumber = $email = $emergencyContact = $emergencyRelationship = $medicalHistory = $billingPerYear = "";
$firstName_err = $lastName_err = $dateOfBirth_err = $gender_err = $phoneNumber_err = $email_err = $emergencyContact_err = $emergencyRelationship_err = $medicalHistory_err = $billingPerYear_err = "";

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

    // Validate gender
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please select a gender.";
    } else{
        $gender = $input_gender;
    }

    // Validate phone number
    $input_phoneNumber = trim($_POST["phoneNumber"]);
    if(empty($input_phoneNumber)){
        $phoneNumber_err = "Please enter a phone number.";
    } else{
        $phoneNumber = $input_phoneNumber;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email address.";
    } else{
        $email = $input_email;
    }

    // Validate emergency contact
    $input_emergencyContact = trim($_POST["emergencyContact"]);
    if(empty($input_emergencyContact)){
        $emergencyContact_err = "Please enter an emergency contact number.";
    } else{
        $emergencyContact = $input_emergencyContact;
    }

    // Validate emergency relationship
    $input_emergencyRelationship = trim($_POST["emergencyRelationship"]);
    if(empty($input_emergencyRelationship)){
        $emergencyRelationship_err = "Please enter the relationship with the emergency contact.";
    } else{
        $emergencyRelationship = $input_emergencyRelationship;
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
    if(empty($firstName_err) && empty($lastName_err) && empty($dateOfBirth_err) && empty($gender_err) && empty($phoneNumber_err) && empty($email_err) && empty($emergencyContact_err) && empty($emergencyRelationship_err) && empty($medicalHistory_err) && empty($billingPerYear_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Members (FirstName, LastName, DateOfBirth, Gender, PhoneNumber, Email, EmergencyContact, EmergencyRelationship, MedicalHistory, BillingPerYear) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssssd", $firstName, $lastName, $dateOfBirth, $gender, $phoneNumber, $email, $emergencyContact, $emergencyRelationship, $medicalHistory, $billingPerYear);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: /members/index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
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
    <title>Add Member</title>
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
        <h2>Add Member</h2>
        <form action="#" method="post">
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
                <input required type="date" name="dateOfBirth" class="form-control <?php echo (!empty($dateOfBirth_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($dateOfBirth); ?>">
                <span class="invalid-feedback"><?php echo $dateOfBirth_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Gender</label>
                <select required name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
                    <option value="Male" <?php if($gender === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($gender === 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if($gender === 'Other') echo 'selected'; ?>>Other</option>
                </select>
                <span class="invalid-feedback"><?php echo $gender_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Phone Number</label>
                <input required type="tel" name="phoneNumber" class="form-control <?php echo (!empty($phoneNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneNumber; ?>">
                <span class="invalid-feedback"><?php echo $phoneNumber_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input required type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Emergency Contact</label>
                <input required type="text" name="emergencyContact" class="form-control <?php echo (!empty($emergencyContact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emergencyContact; ?>">
                <span class="invalid-feedback"><?php echo $emergencyContact_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Emergency Relationship</label>
                <input required type="text" name="emergencyRelationship" class="form-control <?php echo (!empty($emergencyRelationship_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emergencyRelationship; ?>">
                <span class="invalid-feedback"><?php echo $emergencyRelationship_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Medical History</label>
                <textarea name="medicalHistory" class="form-control <?php echo (!empty($medicalHistory_err)) ? 'is-invalid' : ''; ?>"><?php echo $medicalHistory; ?></textarea>
                <span class="invalid-feedback"><?php echo $medicalHistory_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Billing Per Year</label>
                <input required type="number" name="billingPerYear" class="form-control <?php echo (!empty($billingPerYear_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $billingPerYear; ?>">
                <span class="invalid-feedback"><?php echo $billingPerYear_err; ?></span>
            </div>
            <input required type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>
