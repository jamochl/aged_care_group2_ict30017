<?php
include '../config.php'; 


$sql = "SELECT Name, Description, Quantity, Purpose, OwnerDetails, OwnerType FROM Inventory";
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
        <?php if (isset($error_msg)): ?>
            <p><?php echo $error_msg; ?></p>
        <?php else: ?>

            <form class="mb-3">
              <input class="form-control" type="text" id="searchInput" placeholder="Search by item name...">
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryData as $item): ?>
                        <tr>
                            <td><?php echo $item['Name']; ?></td>
                            <td><?php echo $item['Description']; ?></td>
                            <td><?php echo $item['Quantity']; ?></td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                    data-name="<?php echo $item['Name']; ?>" 
                                    data-description="<?php echo $item['Description']; ?>" 
                                    data-quantity="<?php echo $item['Quantity']; ?>" 
                                    data-purpose="<?php echo $item['Purpose']; ?>" 
                                    data-ownerdetails="<?php echo $item['OwnerDetails']; ?>" 
                                    data-ownertype="<?php echo $item['OwnerType']; ?>">View More</button>
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
                    <p><strong>Purpose:</strong> <span id="modal-purpose"></span></p>
                    <p><strong>Owner Details:</strong> <span id="modal-owner-details"></span></p>
                    <p><strong>Owner Type:</strong> <span id="modal-owner-type"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


        // search functionality
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
