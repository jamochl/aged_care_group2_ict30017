<?php
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Create mysqli connection
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if itemName is set in the query parameters
if(isset($_GET['itemName'])) {
    $itemName = $_GET['itemName'];

    // Fetch the item details from the database based on the itemName
    $sql = "SELECT * FROM Inventory WHERE Name = ?";
    $stmt = $mysqli->prepare($sql);

    if($stmt) {
        $stmt->bind_param("s", $itemName);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            // Display a form for editing the quantity
            ?>
            <form method="post" action="update_quantity.php">
                <input type="hidden" name="itemName" value="<?php echo $itemName; ?>">
                <label for="newQuantity">New Quantity:</label>
                <input type="number" name="newQuantity" id="newQuantity" value="<?php echo $item['Quantity']; ?>" required>
                <button type="submit">Update Quantity</button>
            </form>
            <?php
        } else {
            echo "Item not found.";
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Item not specified.";
}
?>
