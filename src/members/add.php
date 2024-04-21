<?php include '../config.php'; ?>

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
        <div>
            <!-- Display the generated breadcrumbs -->
            &gt; <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Add new member</h1>
        <hr>

<style>
    .error-message {
        color: red;
        margin-left: 123px;
        text-align:end;
        
    }

    .label {
        width: 120px;
    }
</style>
<?php
$checkerror = 0; 
$memberId = "";
$fname = "";
$lname = "";
$dob = "";
$contact = "";
$fcontact = "";
$medhistory = "";
$bpy = "";

$pattern1 = "/^\d+$/"; //validation pattern for only numbers
$pattern2 = "/^[a-zA-Z\s]+$/"; // validation pattern for only alphanumerics
$pattern3 = "/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{2}$/"; //date of birth validation
$pattern4 = "/[\w]+(@)[a-zA-Z]+?(\.[a-zA-Z]+)+/"; // validation pattern for email 
?>

    <form action="/members/add.php" method="POST">
    
    <?php
        if(!empty($_POST["submit"]))
        {  
         
            $memberId = $_POST["memberId"];
            
            //id validation
            if(empty($memberId))
            {
                echo "<span class='error-message'>Member ID cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern1, $memberId) === 0)
            {
                echo "<span class='error-message'>Member ID can only contain digits between 0-9.</span><br>";
                $checkerror = $checkerror +1;
            }
            else 
            {
                // Prepare the query to check if the ID exists
                $query = "SELECT * FROM Members WHERE Id = $memberId";

                // Execute the query
                $result = $mysqli->query($query);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // ID already exists
                    echo "<span class='error-message'>Id already exists.</span><br>";
                    $checkerror = $checkerror +1;
                  
            }
            }
        }
    ?>

        <label class="label" for="memberId" > Member ID: </label>
        <input type="text" name="memberId" id="memberId" value="<?php echo $memberId; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $fname = $_POST["fname"];
            
            //first name validation
            if(empty($fname))
            {
                echo "<span class='error-message'>First name cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $fname) === 0)
            {
                echo "<span class='error-message'>First name can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
 
        <label class="label" for="fname"> First Name:  </label>
        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $lname = $_POST["lname"];
            
            //first name validation
            if(empty($lname))
            {
                echo "<span class='error-message'>Last name cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $lname) === 0)
            {
                echo "<span class='error-message'>Last name can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="lname"> Last Name: </label>
        <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $dob = $_POST["dob"];
    
            //date of birth validation
            if(empty($dob))
            {
                echo "<span class='error-message'>Date of birth cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern3, $dob) === 0)
            {
                echo "<span class='error-message'>Date must be in yy/mm/dd format.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="dob"> Date of Birth: </label>
        <input type="date" name="dob" id="dob" value=""> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $contact = $_POST["contact"];
   
           //contact validation
            if(empty($contact))
            {
                echo "<span class='error-message'>Contact cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern4, $contact) === 0)
            {
                echo "<span class='error-message'>Email must be in name123@example.com format.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
    
        <label class="label" for="contact"> Contact:</label>
        <input type="text" name="contact" id="contact" value="<?php echo $contact; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $fcontact = $_POST["fcontact"];
            
            //family contact validation
            if(empty($fcontact))
            {
                echo "<span class='error-message'>Family contact cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
    
        <label class="label" for="fcontact"> Family Contact: </label>
        <input type="text" name="fcontact" id="fcontact" value="<?php echo $fcontact; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $medhistory = $_POST["medhistory"];
            
            //medical history validation
            if(empty($medhistory))
            {
                echo "<span class='error-message'>Medical history cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="medhistory"> Medical History:</label>
        <textarea name="medhistory" id="medhistory" maxlength="260" width="300px" style="width: 300px; height: 100px;" ><?php echo $medhistory; ?></textarea> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $bpy = $_POST["bpy"];
            
            //billing per yeat validation
            if(empty($bpy))
            {
                echo "<span class='error-message'>Billing per year cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
    
        <label class="label" for="bpy"> Billing Per Year: </label>
        <input type="text" name="bpy" id="bpy" value="<?php echo $bpy; ?>"> <br><br>

        <input type="submit" name="submit" value="submit">
    </form>

</body>
</html>
<?php
    
    if(!empty($_POST["submit"]))
    {  
     
        $memberId = $_POST["memberId"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        $contact = $_POST["contact"];
        $fcontact = $_POST["fcontact"];
        $medhistory = $_POST["medhistory"];
        $bpy = $_POST["bpy"];  
                
        if($checkerror == 0) 
        {
  
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
    }

?>

