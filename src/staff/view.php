<?php include '../config.php'; ?>

<?php
$tables = "Staff";
$id = $_GET["id"];
// Array of tables to select data from
$stmt = $mysqli->execute_query("SELECT * FROM $tables WHERE Id = ?", [$id]);
if (!$stmt) {
    echo "Failed to collect data from MySQL: " . $mysqli->connect_error;
    exit();
}
$row = $stmt->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Employee Information</h1>
    <?php
    $date = $row['BirthDate'];
    echo "<div class='container mt-5'>";
    echo "<div class='row'>";
    echo "<div class='col-md-6 offset-md-3'>";
    echo "<div class='card'>";
    echo "<div class='card-header'><h2>Employee Details</h2></div>";
    echo "<div class='card-body'>";
    echo "<div class='form-group'>";
    echo "<label for='name'>Name: {$row['Name']}</label>";
    echo "</div>";
    echo "<div class='form-group'>";
    if ($row['RoleId'] == 1) {
        $role = "Admin";
    } elseif ($row['RoleId'] == 2) {
        $role = "Staff";
    } elseif ($row['RoleId'] == 3) {
        $role = "Cleaner";
    } elseif ($row['RoleId'] == 4) {
        $role = "Account";
    }
    echo "<label for='Role'>Role: {$role}</label>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='email'>Email: {$row['Contact']}</label>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='phone'>Phone Number: {$row['PhoneNumber']}</label>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='nationality'>Nationality: {$row['Nationality']}</label>";
    echo "</div>";
    echo "<div class='form-group'>";
    echo "<label for='Birthdate'>Birthdate: $date</label>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    ?>
    </div>
</body>

</html>