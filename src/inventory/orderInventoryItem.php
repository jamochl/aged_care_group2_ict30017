<?php include'../config.php'?>

<?php 

$success_msg = "";

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
            $Name = $row["Name"];
           $Quantity = $row["Quantity"];

           $supplier = $row["supplier"];
            
        } else{
            // URL doesn't contain valid id parameter. Redirect to error page
            header("location: /error.php");
            exit();
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $success_msg = "order sent";
}

// Close statement
$stmt->close();

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
        <h2>Confirm Order</h2>

        <?php if (!empty($success_msg)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_msg; ?>
            </div>
            <p>You will be redirected back to the Inventory page in a few seconds...</p>
            <script>
                // Redirect back to login page after 3 seconds
                setTimeout(function() {
                    window.location.href = "view.php";
                }, 3000);
            </script>

        <?php else : ?>

        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <h5>Name: <?php echo $Name; ?></h5>
                <h5>Supplier: <?php echo $supplier; ?></h5>


                <p>
                Quantity: <input required type="Number" name="Quantity" class="form-control <?php echo (!empty($Quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Quantity; ?>">
                </p>
                
                <span class="invalid-feedback"><?php echo $Quantity_err; ?></span>
            </div>
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
            <input required type="submit" class="btn btn-primary" value="Order Item">


            <a href="view.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>

        <?php endif; ?>
    </div>
</body>
</html>
