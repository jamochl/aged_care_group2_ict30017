<?php
include '../config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize search and filter variables
$search = isset($_GET['search']) ? $_GET['search'] : '';
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch distinct categories for the dropdown filter
$categoriesQuery = "SELECT DISTINCT ItemCategory FROM Inventory";
$categoriesResult = $mysqli->query($categoriesQuery);

// Function to generate the WHERE clause based on search and filter inputs
function generateWhereClause($search, $categoryFilter) {
    $whereClause = "WHERE 1=1";
    if (!empty($search)) {
        $search = $GLOBALS['mysqli']->real_escape_string($search);
        $whereClause .= " AND (Name LIKE '%$search%' OR Description LIKE '%$search%' OR ItemCategory LIKE '%$search%' OR storageLocation LIKE '%$search%' OR supplier LIKE '%$search%' OR supplierNumber LIKE '%$search%')";
    }
    if (!empty($categoryFilter)) {
        $categoryFilter = $GLOBALS['mysqli']->real_escape_string($categoryFilter);
        $whereClause .= " AND ItemCategory = '$categoryFilter'";
    }
    return $whereClause;
}

// Fetch out-of-stock items based on search and filter inputs
$outOfStockQuery = "SELECT Id, Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber
                    FROM Inventory
                    " . generateWhereClause($search, $categoryFilter) . "
                    AND Quantity = 0";
$outOfStockResult = $mysqli->query($outOfStockQuery);

// Fetch in-stock items based on search and filter inputs
$inStockQuery = "SELECT Id, Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber
                 FROM Inventory
                 " . generateWhereClause($search, $categoryFilter) . "
                 AND Quantity > 0";
$inStockResult = $mysqli->query($inStockQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Inventory</h1>

        <!-- Search and Filter Form -->
        <form method="GET" action="#" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <?php
                        if ($categoriesResult->num_rows > 0) {
                            while ($row = $categoriesResult->fetch_assoc()) {
                                $selected = ($row['ItemCategory'] == $categoryFilter) ? 'selected' : '';
                                echo "<option value='{$row['ItemCategory']}' $selected>{$row['ItemCategory']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <h2>Out of Stock</h2>
        <?php
        if ($outOfStockResult->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr>";
            echo "<th>Name</th>";
            echo "<th>Category</th>";
            echo "<th>Description</th>";
            echo "<th>Quantity</th>";
            echo "<th>Storage Location</th>";
            echo "<th>Supplier</th>";
            echo "<th>Supplier Number</th>";
            echo "<th>Actions</th>";
            echo "</tr></thead><tbody>";
            while ($row = $outOfStockResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['ItemCategory']}</td>";
                echo "<td>{$row['Description']}</td>";
                echo "<td>{$row['Quantity']}</td>";
                echo "<td>{$row['storageLocation']}</td>";
                echo "<td>{$row['supplier']}</td>";
                echo "<td>{$row['supplierNumber']}</td>";
                echo "<td>";
                echo "<a href='view.php?id=" . $row['Id'] . "' class='btn btn-primary ml-2'>View</a>";
                echo "<a href='edit.php?id=" . $row['Id'] . "' class='btn btn-primary'>Edit</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No out-of-stock data available";
        }
        ?>

        <hr>

        <h2>In Stock</h2>
        <?php
        if ($inStockResult->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr>";
            echo "<th>Name</th>";
            echo "<th>Category</th>";
            echo "<th>Description</th>";
            echo "<th>Quantity</th>";
            echo "<th>Storage Location</th>";
            echo "<th>Supplier</th>";
            echo "<th>Supplier Number</th>";
            echo "<th>Actions</th>";
            echo "</tr></thead><tbody>";
            while ($row = $inStockResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['ItemCategory']}</td>";
                echo "<td>{$row['Description']}</td>";
                echo "<td>{$row['Quantity']}</td>";
                echo "<td>{$row['storageLocation']}</td>";
                echo "<td>{$row['supplier']}</td>";
                echo "<td>{$row['supplierNumber']}</td>";
                echo "<td>";
                echo "<a href='view.php?id=" . $row['Id'] . "' class='btn btn-primary ml-2'>View</a>";
                echo "<a href='edit.php?id=" . $row['Id'] . "' class='btn btn-primary'>Edit</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No in-stock data available";
        }

        // Free result sets
        $outOfStockResult->free();
        $inStockResult->free();

        // Close connection
        $mysqli->close();
        ?>
        <a href="/inventory/add.php" class="btn btn-primary add-button button-gap my-4">Add Item</a>
    </div> 
</body>
</html>
