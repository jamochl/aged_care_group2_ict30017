<?php
include '../config.php';

// Fetch room list from the database
$roomQuery = "SELECT Id, Name FROM Room";
$roomResult = $mysqli->query($roomQuery);

// Fetch member list from the database
$memberQuery = "SELECT Id, FirstName, LastName FROM Members";
$memberResult = $mysqli->query($memberQuery);

// Initialize variables for messages
$message = "";
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both roomId and memberId are set
    if (isset($_POST['roomId']) && isset($_POST['memberId'])) {
        // Sanitize inputs to prevent SQL injection
        $roomId = $mysqli->real_escape_string($_POST['roomId']);
        $memberId = $mysqli->real_escape_string($_POST['memberId']);

        // Update the Room table to allocate the member and set availability to 0 (Booked)
        $updateQuery = "UPDATE Room SET BookedFor = $memberId, Availability = 0 WHERE Id = $roomId";

        if ($mysqli->query($updateQuery)) {
            // Allocation successful
            $message = "Room allocated successfully!";
        } else {
            // Allocation failed
            $error = "Failed to allocate room. Please try again.";
        }
    } else {
        // Missing roomId or memberId
        $error = "Please select both room and member.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocate Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
    <div class="container mt-5">
        <h1>Allocate Room</h1>
        <?php if(!empty($message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <?php if(!empty($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="#">
            <div class="mb-3">
                <label for="roomId" class="form-label">Room:</label>
                <select class="form-select" id="roomId" name="roomId">
                    <option selected disabled>Select Room</option>
                    <?php
                    // Loop through the room results and generate options
                    while ($roomRow = $roomResult->fetch_assoc()) {
                        echo "<option value='" . $roomRow['Id'] . "'>" . $roomRow['Name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="memberId" class="form-label">Member:</label>
                <select class="form-select" id="memberId" name="memberId">
                    <option selected disabled>Select Member</option>
                    <?php
                    // Loop through the member results and generate options
                    while ($memberRow = $memberResult->fetch_assoc()) {
                        echo "<option value='" . $memberRow['Id'] . "'>" . $memberRow['FirstName'] . " " . $memberRow['LastName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Allocate</button>
        </form>
    </div>
</body>
</html>
