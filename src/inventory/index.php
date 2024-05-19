<?php
include '../config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch distinct categories for the dropdown filter
$categoriesQuery = "SELECT DISTINCT ItemCategory FROM Inventory";
$categoriesResult = $mysqli->query($categoriesQuery);

// Fetch all inventory items
$inventoryQuery = "SELECT Id, Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber FROM Inventory";
$inventoryResult = $mysqli->query($inventoryQuery);
$inventoryItems = [];
while ($row = $inventoryResult->fetch_assoc()) {
    $inventoryItems[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Inventory</h1>

        <!-- Search and Filter Form -->
        <form id="searchForm" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="category" name="category">
                        <option value="">All Categories</option>
                        <?php
                        if ($categoriesResult->num_rows > 0) {
                            while ($row = $categoriesResult->fetch_assoc()) {
                                echo "<option value='{$row['ItemCategory']}'>{$row['ItemCategory']}</option>";
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
        <div id="outOfStockTable">
            <!-- Out of Stock table will be dynamically inserted here -->
        </div>

        <hr>

        <h2>In Stock</h2>
        <div id="inStockTable">
            <!-- In Stock table will be dynamically inserted here -->
        </div>

        <a href="/inventory/add.php" class="btn btn-primary add-button button-gap my-4">Add Item</a>
    </div>

    <script>
        $(document).ready(function() {
            // Inventory data from PHP
            const inventoryItems = <?php echo json_encode($inventoryItems); ?>;

            // Function to render the tables
            function renderTables(filteredItems) {
                // Split items into out-of-stock and in-stock
                const outOfStockItems = filteredItems.filter(item => item.Quantity == 0);
                const inStockItems = filteredItems.filter(item => item.Quantity > 0);

                // Function to generate table rows
                function generateTableRows(items) {
                    return items.map(item => `
                        <tr>
                            <td>${item.Name}</td>
                            <td>${item.ItemCategory}</td>
                            <td>${item.Description}</td>
                            <td>${item.Quantity}</td>
                            <td>${item.storageLocation}</td>
                            <td>${item.supplier}</td>
                            <td>${item.supplierNumber}</td>
                            <td>
                                <a href='orderInventoryItem.php?id=${item.Id}' class='btn btn-success'>Order Item</a>
                                <a href='view.php?id=${item.Id}' class='btn btn-primary ml-2'>View</a>
                                <a href='edit.php?id=${item.Id}' class='btn btn-primary'>Edit</a>
                            </td>
                        </tr>
                    `).join('');
                }

                // Generate and display out-of-stock table
                if (outOfStockItems.length > 0) {
                    $('#outOfStockTable').html(`
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Storage Location</th>
                                    <th>Supplier</th>
                                    <th>Supplier Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${generateTableRows(outOfStockItems)}
                            </tbody>
                        </table>
                    `);
                } else {
                    $('#outOfStockTable').html("No out-of-stock data available");
                }

                // Generate and display in-stock table
                if (inStockItems.length > 0) {
                    $('#inStockTable').html(`
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Storage Location</th>
                                    <th>Supplier</th>
                                    <th>Supplier Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${generateTableRows(inStockItems)}
                            </tbody>
                        </table>
                    `);
                } else {
                    $('#inStockTable').html("No in-stock data available");
                }
            }

            // Function to filter items
            function filterItems() {
                const search = $('#search').val().toLowerCase();
                const category = $('#category').val();

                const filteredItems = inventoryItems.filter(item => {
                    const matchesSearch = search === '' || item.Name.toLowerCase().includes(search) || item.Description.toLowerCase().includes(search) || item.ItemCategory.toLowerCase().includes(search) || item.storageLocation.toLowerCase().includes(search) || item.supplier.toLowerCase().includes(search) || item.supplierNumber.toString().includes(search);
                    const matchesCategory = category === '' || item.ItemCategory === category;
                    return matchesSearch && matchesCategory;
                });

                renderTables(filteredItems);
            }

            // Initial render
            filterItems();

            // Event listeners for search and category filter
            $('#searchForm').on('submit', function(event) {
                event.preventDefault();
                filterItems();
            });

            $('#search').on('input', filterItems);
            $('#category').on('change', filterItems);
        });
    </script>
</body>
</html>
