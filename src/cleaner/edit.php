<?php include '../config.php'; ?>
<?php
// Check if ID parameter exists
if (!isset($_GET['id'])) {
    echo "Error: ID parameter is missing.";
    exit();
}

// Define variables and initialize with empty values
$progress = "";
$progress_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and save Progress
    $progress = isset($_POST["progress"]) ? intval($_POST["progress"]) : 0;

    // Prepare an update statement
    $sql = "UPDATE ServiceRecords SET Progress=? WHERE Id=?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ii", $progress, $_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records updated successfully. Redirect to landing page
            header("location: /service_records/my.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();
}

// Get service record details
$id = $_GET["id"];
$sql = "SELECT Progress FROM ServiceRecords WHERE Id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($progress);
            $stmt->fetch();
        } else {
            echo "No records found.";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Service Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper {
            max-width: 500px;
            margin: 0 auto;
        }

        textarea[disabled] {
            background-color: #e9ecef;
            pointer-events: none;
        }
    </style>
</head>
<body>
<div class="wrapper p-3">
    <h2>Edit Service Record</h2>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="mb-3">
            <label for="progress" class="form-label">Progress</label>
            <select name="progress" id="progress" class="form-select">
                <option value="0" <?php if ($progress == 0) echo "selected"; ?>>Not Completed</option>
                <option value="1" <?php if ($progress == 1) echo "selected"; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
