<?php include '../config.php'; ?>
<?php
// Define variables and initialize with empty values
$startTime = $endTime = "";
$startTime_err = $endTime_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate start time
    $input_startTime = trim($_POST["startTime"]);
    if(empty($input_startTime)){
        $startTime_err = "Please enter a start time.";
    } else{
        $startTime = $input_startTime;
    }
    
    // Validate end time
    $input_endTime = trim($_POST["endTime"]);
    if(empty($input_endTime)){
        $endTime_err = "Please enter an end time.";     
    } else{
        $endTime = $input_endTime;
    }
    
    // Check input errors before inserting into database
    if(empty($startTime_err) && empty($endTime_err)){
        // Prepare an update statement
        $sql = "UPDATE Availabilities SET StartTime=?, EndTime=? WHERE Id=?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssi", $param_startTime, $param_endTime, $param_id);
            
            // Set parameters
            $param_startTime = $startTime;
            $param_endTime = $endTime;
            $param_id = $_POST["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: /rosters/index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
} else {
    // Retrieve availability data
    $id = $_GET["id"];
    $sql = "SELECT StartTime, EndTime FROM Availabilities WHERE Id = ?";
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        $param_id = $id;
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $stmt->bind_result($startTime, $endTime);
                $stmt->fetch();
            } else{
                echo "No records found.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Availability</title>
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
        <h2>Edit Availability</h2>
        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="mb-3">
                <label for="startTime" class="form-label">Start Time</label>
                <input required type="datetime-local" name="startTime" id="startTime" class="form-control" value="<?php echo htmlspecialchars($startTime); ?>">
                <span class="text-danger"><?php echo $startTime_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">End Time</label>
                <input required type="datetime-local" name="endTime" id="endTime" class="form-control" value="<?php echo htmlspecialchars($endTime); ?>">
                <span class="text-danger"><?php echo $endTime_err; ?></span>
            </div>
            <input required type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/rosters/my.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>    
</body>
</html>
