<?php include '../config.php'; ?>

<?php

$sql = "SELECT Id, Name, ItemCategory, Description, Quantity, storageLocation, supplier, supplierNumber FROM Inventory";
$result = $mysqli->query($sql);

// Initialize an array to hold the inventory data
$inventoryData = [];

if ($result->num_rows > 0) {
    // Loop through each row of the result set and store data in the inventoryData array
    while ($row = $result->fetch_assoc()) {
        $inventoryData[] = $row;
    }
} else {
    // No inventory records found
    $error_msg = "No inventory records found.";
}

// Assuming you have a database connection named $conn
$itemCategories = array();

// Query to select distinct categories from the Inventory table
$sql = "SELECT DISTINCT ItemCategory FROM Inventory";

// Execute the query
$result = $mysqli->query($sql);


if ($result) {
    
    while ($row = $result->fetch_assoc()) {
        // Add the category to the $itemCategories array
        $itemCategories[] = $row['ItemCategory'];
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Inventory</h2>

        <!-- <div>
            
            <?php generateBreadcrumbs(); ?>
        </div> -->

        <?php if (isset($error_msg)): ?>
            <p><?php echo $error_msg; ?></p>
        <?php else: ?>

            <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>

            <form class="mb-3">
              <input class="form-control" type="text" id="searchInput" placeholder="Search by item name...">

              <select class="form-select mt-2" id="categorySelect" aria-label="Select item category">
                <option selected>Select category...</option>
                <?php foreach ($itemCategories as $category): ?>
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>
              
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryData as $item): ?>
                        <tr>
                            
                            <td><?php echo $item['Name']; ?></td>
                            <td><?php echo $item['ItemCategory']?></td>
                            <td><?php echo $item['Quantity']; ?></td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                    data-name="<?php echo $item['Name']; ?>" 
                                    data-description="<?php echo $item['Description']; ?>" 
                                    data-quantity="<?php echo $item['Quantity']; ?>"

                                    data-storage="<?php echo $item['storageLocation']; ?>"

                                    data-supplier="<?php echo $item['supplier']; ?>"
                                    data-supplierNum="<?php echo $item['supplierNumber']; ?>"
                                    >View More</button>
                                    
                                    <!-- <button class="btn btn-primary edit-quantity" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="<?php echo $item['Id']; ?>"
                                    data-quantity="<?php echo $item['Quantity']; ?>">Edit Quantity</button> -->                                    
                                    <?php echo "<td><a href='/inventory/edit.php?id={$item['Id']}' class='btn btn-primary'>Edit</a></td>";?>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inventory Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modal-name"></span></p>
                    <p><strong>Description:</strong> <span id="modal-description"></span></p>
                    <p><strong>Quantity:</strong> <span id="modal-quantity"></span></p>

                    <p><strong>Location:</strong> <span id="modal-storage"></span></p>

                    <p><strong>Supplier Name:</strong> <span id="modal-supplier"></span></p>
                    <p><strong>Supplier Number:</strong> <span id="modal-supplierNum"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- populate modal with item details -->
    <script>

        function goBack(){
            window.location.href="/";
        }

        var myModal = document.getElementById('exampleModal');
        myModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var name = button.getAttribute('data-name');
            var description = button.getAttribute('data-description');
            var quantity = button.getAttribute('data-quantity');
            var storage = button.getAttribute('data-storage');

            var supplier = button.getAttribute('data-supplier');
            var supplierNum = button.getAttribute('data-supplierNum');

            document.getElementById('modal-name').textContent = name;
            document.getElementById('modal-description').textContent = description;
            document.getElementById('modal-quantity').textContent = quantity;
            document.getElementById('modal-storage').textContent = storage;

            document.getElementById('modal-supplier').textContent = supplier;
            document.getElementById('modal-supplierNum').textContent = supplierNum;

        });


        //search functionality
        // document.getElementById("searchInput").addEventListener("keyup", function() {
        //     var input, filter, table, tr, td, i, txtValue;
        //     input = document.getElementById("searchInput");
        //     filter = input.value.toUpperCase();
        //     table = document.querySelector("table");
        //     tr = table.getElementsByTagName("tr");
        //     for (i = 0; i < tr.length; i++) {
        //         td = tr[i].getElementsByTagName("td")[0];
        //         if (td) {
        //             txtValue = td.textContent || td.innerText;
        //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                 tr[i].style.display = "";
        //             } else {
        //                 tr[i].style.display = "none";
        //             }
        //         }
        //     }
        // });


        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input, filter, table, tr, tdName, tdCategory, i, txtValueName, txtValueCategory;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                tdName = tr[i].getElementsByTagName("td")[0];
                tdCategory = tr[i].getElementsByTagName("td")[1]; // Adjust index for category column
                if (tdName && tdCategory) {
                    txtValueName = tdName.textContent || tdName.innerText;
                    txtValueCategory = tdCategory.textContent || tdCategory.innerText;
                    if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueCategory.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });

        document.getElementById("categorySelect").addEventListener("change", function() {
            var selectedCategory, table, tr, tdCategory, i;
            selectedCategory = this.value.toUpperCase(); // Get the selected category and convert to uppercase
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                tdCategory = tr[i].getElementsByTagName("td")[1]; // Assuming category is in the third column (index 2)
                if (tdCategory) {
                    if (selectedCategory === "SELECT CATEGORY..." || tdCategory.textContent.toUpperCase() === selectedCategory) {
                        tr[i].style.display = ""; // Display rows matching the selected category or show all rows if "Select category..." is chosen
                    } else {
                        tr[i].style.display = "none"; // Hide rows not matching the selected category
                    }
                }
            }
        });




    </script>
</body>
</html>
