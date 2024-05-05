<?php include '../config.php'; ?>
<?php
$Quantity = "";
$Quantity_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_Quantity = trim($_POST["Quantity"]);
    if(empty($input_Quantity)){
        $Quantity_err = "Please enter quantity";
    } else{
        $Quantity = $input_Quantity;
    }


    // Check input errors before updating the database
    if(empty($Quantity_err)){
        // Prepare an update statement
        $sql = "UPDATE Inventory SET Quantity=? WHERE Id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ii", $param_Quantity , $param_id);

            // Set parameters
            $param_Quantity = $Quantity;
            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: /inventory/view.php");
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


} else {
    // Prepare a select statement
    $sql = "SELECT * FROM Inventory WHERE Id = ?";
    
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
               $Quantity = $row["Quantity"];
                
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
    <title>Edit Inventory</title>
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
        <h2>Edit Quantity</h2>
        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <input required type="Number" name="Quantity" class="form-control <?php echo (!empty($Quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Quantity; ?>">
                <span class="invalid-feedback"><?php echo $Quantity_err; ?></span>
            </div>
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
            <input required type="submit" class="btn btn-primary" value="Submit">


            <a href="view.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </div>
</body>
</html>