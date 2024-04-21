<?php
// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Define variables and initialize with empty values
$rosterId = $memberId = $serviceType = $startTime = $endTime = $managedLocationId = $notes = "";
$member_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate member
    $input_memberId = trim($_POST["memberId"]);
    if(empty($input_memberId)){
        $member_err = "Please select a member.";
    } else{
        $memberId = $input_memberId;
    }

    // Check input errors before inserting into database
    if(empty($member_err)){
        // Prepare an update statement
        $sql = "UPDATE ServiceRecords SET MemberId=?, ServiceType=?, StartTime=?, EndTime=?, ManagedLocationId=?, Notes=? WHERE Id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("isssisi", $param_memberId, $param_serviceType, $param_startTime, $param_endTime, $param_managedLocationId, $param_notes, $param_id);

            // Set parameters
            $param_memberId = $memberId;
            $param_serviceType = $_POST["serviceType"];
            $param_startTime = $_POST["startTime"];
            $param_endTime = $_POST["endTime"];
            $param_managedLocationId = $_POST["managedLocationId"];
            $param_notes = $_POST["notes"];
            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: my_services.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }
}

// Get service record details
$id = $_GET["id"];
$sql = "SELECT RosterId, MemberId, ServiceType, StartTime, EndTime, ManagedLocationId, Notes FROM ServiceRecords WHERE Id = ?";
if($stmt = $mysqli->prepare($sql)){
    $stmt->bind_param("i", $param_id);
    $param_id = $id;
    if($stmt->execute()){
        $stmt->store_result();
        if($stmt->num_rows == 1){
            $stmt->bind_result($rosterId, $memberId, $serviceType, $startTime, $endTime, $managedLocationId, $notes);
            $stmt->fetch();
        } else{
            echo "No records found.";
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
    $stmt->close();
}

// Get list of members for dropdown
$members = [];
$sql = "SELECT Id, CONCAT(FirstName, ' ', LastName) AS FullName FROM Members";
if($result = $mysqli->query($sql)){
    while($row = $result->fetch_assoc()){
        $members[] = $row;
    }
    $result->free();
}

// Get list of managed locations for dropdown
$locations = [];
$sql = "SELECT Id, Name FROM ManagedLocations";
if($result = $mysqli->query($sql)){
    while($row = $result->fetch_assoc()){
        $locations[] = $row;
    }
    $result->free();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Service Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .wrapper{
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper p-3">
        <h2>Edit Service Record</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . htmlspecialchars($id); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <div class="mb-3">
                <label for="memberId" class="form-label">Member</label>
                <select name="memberId" id="memberId" class="form-select">
                    <option value="">Select a member</option>
                    <?php foreach($members as $member): ?>
                        <option value="<?php echo $member['Id']; ?>" <?php if($memberId == $member['Id']) echo "selected"; ?>><?php echo htmlspecialchars($member['FullName']); ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger"><?php echo $member_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="serviceType" class="form-label">Service Type</label>
                <input type="text" name="serviceType" id="serviceType" class="form-control" value="<?php echo htmlspecialchars($serviceType); ?>">
            </div>
            <div class="mb-3">
                <label for="startTime" class="form-label">Start Time</label>
                <input type="datetime-local" name="startTime" id="startTime" class="form-control" value="<?php echo htmlspecialchars($startTime); ?>">
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">End Time</label>
                <input type="datetime-local" name="endTime" id="endTime" class="form-control" value="<?php echo htmlspecialchars($endTime); ?>">
            </div>
            <div class="mb-3">
                <label for="managedLocationId" class="form-label">Managed Location</label>
                <select name="managedLocationId" id="managedLocationId" class="form-select">
                    <option value="">Select a location</option>
                    <?php foreach($locations as $location): ?>
                        <option value="<?php echo $location['Id']; ?>" <?php if($managedLocationId == $location['Id']) echo "selected"; ?>><?php echo htmlspecialchars($location['Name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" id="notes" class="form-control"><?php echo htmlspecialchars($notes); ?></textarea>
            </div>
            <input type="hidden" name="staffId" value="<?php echo htmlspecialchars($staffId); ?>"/>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="my_services.php" class
