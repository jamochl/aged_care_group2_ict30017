<?php 

// Database connection details
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) 
{
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update staff profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

    <h2>Enter Staff ID</h2>
    <form action="Editstaff.php" method="get">
        <label for="id">Staff ID:</label>
        <input type="text" id="id" name="id" required>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php

        $id = '';
        $name = '';
        $email = '';
        $pswrd = '';
        $roleID = '';

    // Check if staff ID is provided via GET request
    if (!empty($_GET['submit'])) {
        // Get staff ID from GET request
        $id = $_GET['id'];

        // SQL query to select staff details by ID
        $query = "SELECT * FROM `Staff` WHERE `id`='$id'";

        // Execute the query
        $result = $mysqli->query($query);

        // Check if a row is returned
        if ($result->num_rows > 0) {
            // Fetch the row data
            $row = $result->fetch_assoc();
            // Assign values to variables
            $id = $row['Id'];
            $name = $row['Name'];
            $pswrd = $row['PasswordHash'];
            $email = $row['Contact'];
            $roleID = $row['RoleId'];
        } else {
            // If no row is returned, display an error message
            echo "No staff found with the provided ID";
        }
    } else {
        // If no staff ID is provided, display an error message
        echo "Staff ID is not provided";
    }
    ?>
    </div>

    <div class="container">
    <h2>Update Staff Details</h2>
    <form action="Editstaff.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden field to submit ID -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
        <label for="pswrd">Password:</label>
        <input type="password" id="pswrd" name="pswrd" value="<?php echo $pswrd; ?>" required><br><br>
        <label for="roleID">Role ID:</label>
        <input type="text" id="roleID" name="roleID" value="<?php echo $roleID; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    
    <?php

if (!empty($_POST['update'])) {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pswrd = $_POST['pswrd'];
    $email = $_POST['email'];
    $roleID = $_POST['roleID'];

    // SQL query to update staff details
    $query = "UPDATE `Staff` SET `Name`='$name', `Contact`='$email', `PasswordHash`='$pswrd', `RoleId`='$roleID' WHERE `id`='$id'";
    $mysqli->query($query);

    $query = "SELECT * FROM `Staff`";
    
    $qresult = $mysqli->query($query); 
}
    ?>
    </div>

    <div class="container mt-5">
        <h1>Staff Data</h1>
        <hr>
        <?php
            $table = "Staff";
            echo "<h2>$table</h2>";
            // SQL query to select all data from the table
            $query = "SELECT * FROM $table";
            // Execute query
            $result = $mysqli->query($query);
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Display data in a table
                echo "<table class='table'>";
                echo "<thead><tr>";
                // Fetch table column names
                $field_names = $result->fetch_fields();
                foreach ($field_names as $field) {
                    echo "<th>$field->name</th>";
                }
                echo "</tr></thead><tbody>";
                // Fetch and display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No data available in $table";
            }
            // Free result set
            $result->free();

        // Close connection
        $mysqli->close();
        ?>
    </div>
</body>

</html>