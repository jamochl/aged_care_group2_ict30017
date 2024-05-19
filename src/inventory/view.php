<?php
include '../config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the item ID from the URL
$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare a select statement to fetch the item details
$sql = "SELECT Id, Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber FROM Inventory WHERE Id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $itemId);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Fetch result row as an associative array
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Retrieve individual field value
            $name = $row["Name"];
            $itemCategory = $row["ItemCategory"];
            $description = $row["Description"];
            $quantity = $row["Quantity"];
            $storageLocation = $row["storageLocation"];
            $supplier = $row["supplier"];
            $supplierNumber = $row["supplierNumber"];
        } else {
            // URL doesn't contain valid id parameter. Redirect to error page
            header("location: /error.php");
            exit();
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper {
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
        <h2>View Item</h2>
        <form action="#" method="post">
            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="form-group mb-3">
                <label>Name</label>
                <input disabled type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Category</label>
                <input disabled type="text" name="itemCategory" class="form-control" value="<?php echo htmlspecialchars($itemCategory); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Description</label>
                <textarea disabled name="description" class="form-control"><?php echo nl2br(htmlspecialchars($description)); ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label>Quantity</label>
                <input disabled type="text" name="quantity" class="form-control" value="<?php echo htmlspecialchars($quantity); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Storage Location</label>
                <input disabled type="text" name="storageLocation" class="form-control" value="<?php echo htmlspecialchars($storageLocation); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Supplier</label>
                <input disabled type="text" name="supplier" class="form-control" value="<?php echo htmlspecialchars($supplier); ?>">
            </div>
            <div class="form-group mb-3">
                <label>Supplier Number</label>
                <input disabled type="text" name="supplierNumber" class="form-control" value="<?php echo htmlspecialchars($supplierNumber); ?>">
            </div>
            <a href="edit.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-primary">Edit Item</a>
        </form>
    </div>
</body>
</html>
