<?php include '../config.php'; ?>
<?php
// Initialize variables for form input
$ItmId = $ItmName = $Purpose = $OwnerDetails = $OwnerType = $Description = $Quantity = $ManagedLocationId = "";
$checkerror = 0;

$pattern1 = "/^\d+$/"; //validation pattern for only numbers
$pattern2 = "/^[a-zA-Z\s]+$/"; // validation pattern for only alphanumerics

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Add new item</h1>
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

    <form action="/inventory/add.php" method="POST">
    
    <?php
        if(!empty($_POST["submit"]))
        {  
         
            $ItmId = $_POST["ItmId"];
            
            //id validation
            if(empty($ItmId))
            {
                echo "<span class='error-message'>Item ID cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern1, $ItmId) === 0)
            {
                echo "<span class='error-message'>Item ID can only contain digits between 0-9.</span><br>";
                $checkerror = $checkerror +1;
            }
            else 
            {
                // Prepare the query to check if the ID exists
                $query = "SELECT * FROM Inventory WHERE Id = $ItmId";

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

        <label class="label" for="ItmId" > Item ID: </label>
        <input required type="text" name="ItmId" id="ItmId" value="<?php echo $ItmId; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $ItmName = $_POST["ItmName"];
            
            //Item name validation
            if(empty($ItmName))
            {
                echo "<span class='error-message'>Item name cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $ItmName) === 0)
            {
                echo "<span class='error-message'>Item name can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
 
        <label class="label" for="ItmName"> Item Name:  </label>
        <input required type="text" name="ItmName" id="ItmName" value="<?php echo $ItmName; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $Purpose = $_POST["Purpose"];
            
            //Purpose validation
            if(empty($Purpose))
            {
                echo "<span class='error-message'>Purpose cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $Purpose) === 0)
            {
                echo "<span class='error-message'>Purpose can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="Purpose"> Purpose: </label>
        <input required type="text" name="Purpose" id="Purpose" value="<?php echo $Purpose; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $OwnerDetails = $_POST["OwnerDetails"];
            
            //Owner details validation
            if(empty($OwnerDetails))
            {
                echo "<span class='error-message'>Owner details cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $OwnerDetails) === 0)
            {
                echo "<span class='error-message'>Owner details can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="OwnerDetails"> Owner details: </label>
        <input required type="text" name="OwnerDetails" id="OwnerDetails" value="<?php echo $OwnerDetails; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $OwnerType = $_POST["OwnerType"];
            
            //Owner types validation
            if(empty($OwnerType))
            {
                echo "<span class='error-message'>Owner type cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern2, $OwnerType) === 0)
            {
                echo "<span class='error-message'>Owner type can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
    
        <label class="label" for="OwnerType"> Owner type:</label>
        <input required type="text" name="OwnerType" id="OwnerType" value="<?php echo $OwnerType; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $Description = $_POST["Description"];
            
            //Description validation
            if(empty($Description))
            {
                echo "<span class='error-message'>Description cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>

        <label class="label" for="Description"> Description:</label>
        <textarea name="Description" id="Description" maxlength="260" width="300px" style="width: 300px; height: 100px;" ><?php echo $Description; ?></textarea> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $Quantity = $_POST["Quantity"];
            
            //Quantity validation
            if(empty($Quantity))
            {
                echo "<span class='error-message'>Quantity cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern1, $Quantity) === 0)
            {
                echo "<span class='error-message'>Quantity can only contain digits between 0-9</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
 
        <label class="label" for="Quantity"> Quantity:  </label>
        <input required type="text" name="Quantity" id="Quantity" value="<?php echo $Quantity; ?>"> <br><br>

        <?php
        if(!empty($_POST["submit"]))
        {  
         
            $ManagedLocationId = $_POST["ManagedLocationId"];
            
            //Managed location id validation
            if(empty($ManagedLocationId))
            {
                echo "<span class='error-message'>Managed location id cannot be empty.</span><br>";
                $checkerror = $checkerror +1;
            }
            else if(preg_match($pattern1, $ManagedLocationId) === 0)
            {
                echo "<span class='error-message'>Managed location id can only contain alphanumeric characters.</span><br>";
                $checkerror = $checkerror +1;
            }
        }
    ?>
 
        <label class="label" for="ManagedLocationId"> Managed Location Id:  </label>
        <input required type="text" name="ManagedLocationId" id="ManagedLocationId" value="<?php echo $ManagedLocationId; ?>"> <br><br>

        <input required type="submit" name="submit" value="submit">
    </form>

</body>
</html>
<?php
    
    if(!empty($_POST["submit"]))
    {  
     
        $ItmId = $_POST["ItmId"];
        $ItmName = $_POST["ItmName"];
        $Purpose = $_POST["Purpose"];
        $OwnerDetails = $_POST["OwnerDetails"];
        $OwnerType = $_POST["OwnerType"];
        $Description = $_POST["Description"];
        $Quantity = $_POST["Quantity"];
        $ManagedLocationId = $_POST["ManagedLocationId"];  
                
        if($checkerror == 0) 
        {
  
        // Check connection
        if ($mysqli->connect_errno) 
        {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
            // ## 2. set up SQL string and execute
        
            $query = "INSERT INTO Inventory (Id, Name, Purpose, OwnerDetails, OwnerType, Description, Quantity, ManagedLocationId) VALUES
            ('$ItmId', '$ItmName', '$Purpose', '$OwnerDetails', '$OwnerType', '$Description', '$Quantity', '$ManagedLocationId')";

            $mysqli->query($query);
            mysqli_close($mysqli);
            
        }
    }

?>