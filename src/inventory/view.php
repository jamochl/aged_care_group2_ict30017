<?php include '../config.php'; ?>

<?php

$sql = "SELECT Id, Name, Description, Quantity FROM Inventory";
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



// Close the database connection
//$mysqli->close();
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

            <form class="mb-3">
              <input class="form-control" type="text" id="searchInput" placeholder="Search by item name...">
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryData as $item): ?>

                        <tr>
                            <td><?php echo $item['Id']; ?></td>
                            <td><?php echo $item['Name']; ?></td>
                            <td><?php echo $item['Quantity']; ?></td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                    data-name="<?php echo $item['Name']; ?>" 
                                    data-description="<?php echo $item['Description']; ?>" 
                                    data-quantity="<?php echo $item['Quantity']; ?>">View More</button>
                                    
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Quantity Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editQuantityForm" method="POST">
                        <div class="mb-3">
                            <label for="newQuantity" class="form-label">New Quantity:</label>
                            <input type="number" class="form-control" id="newQuantity" name="newQuantity" min="0" required>
                            <input type="number" id="itemId" name="itemId">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="#" method="post">
                            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                            <div class="form-group mb-3">
                                <input required type="Number" name="Quantity" class="form-control <?php echo (!empty($Quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Quantity; ?>">
                                <span class="invalid-feedback"><?php echo $Quantity_err; ?></span>
                            </div>
                            <input required type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
                            <input required type="submit" class="btn btn-primary" value="Submit">
                </form>
                </div>
            </div>
        </div>
    </div>


    <!-- populate modal with item details -->
    <script>
        var myModal = document.getElementById('exampleModal');
        myModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var name = button.getAttribute('data-name');
            var description = button.getAttribute('data-description');
            var quantity = button.getAttribute('data-quantity');
            var purpose = button.getAttribute('data-purpose');
            var ownerDetails = button.getAttribute('data-ownerdetails');
            var ownerType = button.getAttribute('data-ownertype');


            document.getElementById('modal-name').textContent = name;
            document.getElementById('modal-description').textContent = description;
            document.getElementById('modal-quantity').textContent = quantity;
            document.getElementById('modal-purpose').textContent = purpose;
            document.getElementById('modal-owner-details').textContent = ownerDetails;
            document.getElementById('modal-owner-type').textContent = ownerType;
        });

        
        // Edit Quantity Modal
        var editQuantityModal = document.getElementById('editModal');
        editQuantityModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var itemId = button.getAttribute('data-id');
            var quantity = button.getAttribute('data-quantity');
            document.getElementById('newQuantity').value = quantity;
            document.getElementById('itemId').value = itemId;
        });

            // Submit edit quantity form
            document.getElementById('editQuantityForm').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Get input values
                var newQuantity = parseInt(document.getElementById('newQuantity').value); // Parse input value as integer
                var itemId = parseInt(document.getElementById('itemId').value);

                // Construct JSON object with form data
                var formData = {
                    newQuantity: newQuantity,
                    itemId: itemId
                };

                // Convert formData object to JSON string
                var jsonData = JSON.stringify(formData);

                // Send JSON data to server using fetch
                fetch('update_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: jsonData // Pass JSON string as the request body
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Log the response message
                    console.log(data.message);
                    // Check if the update was successful
                    if (data.status === 'success') {
                        // Refresh the page to reflect the updated quantity
                        location.reload();
                    } else {
                        // Handle error (display error message or perform other actions)
                        alert('Error updating quantity: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle error (display error message or perform other actions)
                    alert('An error occurred while updating quantity.');
                });
            });


        // search functionality
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });

    </script>
</body>
</html>
