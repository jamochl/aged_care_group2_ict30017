<?php include '../config.php'; ?>
<?php
$id = '';
$name = '';
$email = '';
$pswrd = '';
$roleID = '';

// Check if staff ID is provided via GET request
if (!empty($_GET['id'])) {
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
    header("Location: /staff.php");
    die();
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
    <h2>Update Staff Details</h2>
    <form action="/staff/edit.php" method="post">
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
</body>

</html>
