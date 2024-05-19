<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Roster</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
        <h1>Cleaning Room</h1>
        <?php
            // Define current date and one week ago date
            $currentDate = date('Y-m-d H:i:s');
            $oneWeekAgoDate = date('Y-m-d H:i:s', strtotime('-1 week'));

            // SQL query to get the latest cleaning record for each room within the last week
            $query = "
                SELECT 
                    sr.RoomId, 
                    sr.EndTime, 
                    ml.Name AS ManagedLocationName, 
                    r.Name AS RoomName
                FROM 
                    ServiceRecords sr
                INNER JOIN 
                    ManagedLocations ml ON sr.ManagedLocationId = ml.Id
                INNER JOIN 
                    Room r ON sr.RoomId = r.Id
                WHERE 
                    sr.EndTime >= '$oneWeekAgoDate'
                AND 
                    sr.EndTime <= '$currentDate'
                AND 
                    sr.Progress = 1
                ORDER BY 
                    sr.EndTime DESC
            ";
            
            $result = $mysqli->query($query);

            // Fetch all room records
            $allRoomsQuery = "
                SELECT 
                    r.Id AS RoomId,
                    r.Name AS RoomName,
                    ml.Name AS ManagedLocationName
                FROM 
                    Room r
                INNER JOIN 
                    ManagedLocations ml ON r.ManagedLocationId = ml.Id
            ";
            $allRoomsResult = $mysqli->query($allRoomsQuery);
            $rooms = [];
            while ($room = $allRoomsResult->fetch_assoc()) {
                $rooms[$room['RoomId']] = [
                    'RoomName' => $room['RoomName'],
                    'ManagedLocationName' => $room['ManagedLocationName'],
                    'LastCleaned' => 'N/A',
                    'IsClean' => 'Unclean'
                ];
            }

            // Mark rooms as clean based on recent cleaning records
            while ($row = $result->fetch_assoc()) {
                if (isset($rooms[$row['RoomId']])) {
                    $rooms[$row['RoomId']]['LastCleaned'] = $row['EndTime'];
                    $rooms[$row['RoomId']]['IsClean'] = 'Clean';
                }
            }
        ?>

        <div class="row">
            <div class="col">
                <h2>Room Cleaning Status</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Managed Location</th>
                            <th>Status</th>
                            <th>Last Cleaned</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $roomId => $roomData): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($roomData['RoomName']); ?></td>
                                <td><?php echo htmlspecialchars($roomData['ManagedLocationName']); ?></td>
                                <td><?php echo htmlspecialchars($roomData['IsClean']); ?></td>
                                <td><?php echo $roomData['LastCleaned'] !== 'N/A' ? htmlspecialchars(date('Y-m-d', strtotime($roomData['LastCleaned']))) : 'N/A'; ?></td>
                                <td>
                                    <a href="/cleaner/edit?id=<?php echo $roomId?>" class="btn btn-primary">Edit Status</a>
                                    <a href="/cleaner/add" class="btn btn-primary">Schedule Clean</a>
                                    <a href="/cleaner/index.php?roomid=<?php echo $roomId; ?>" class="btn btn-secondary">Cleaning History</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
            // Free result sets
            $result->free();
            $allRoomsResult->free();
        ?>

        <?php
            // Define current date and one week ago date
            $currentDate = date('Y-m-d H:i:s');
            $oneWeekAgoDate = date('Y-m-d H:i:s', strtotime('-1 week'));

            // SQL query to get all cleaning records within the last week
            $query = "
                SELECT 
                    sr.*, 
                    ml.Name AS ManagedLocationName, 
                    r.Name AS RoomName
                FROM 
                    ServiceRecords sr
                INNER JOIN 
                    ManagedLocations ml ON sr.ManagedLocationId = ml.Id
                INNER JOIN 
                    Room r ON sr.RoomId = r.Id
                WHERE 
                    sr.EndTime >= '$oneWeekAgoDate'
                AND 
                    sr.EndTime <= '$currentDate'
                ORDER BY 
                    sr.EndTime DESC
            ";
            
            $result = $mysqli->query($query);
        ?>

        <div class="row">
            <div class="col">
                <h2>Cleaning Records</h2>
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Managed Location</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['RoomName']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ManagedLocationName']); ?></td>
                                    <td><?php echo htmlspecialchars($row['StartTime']); ?></td>
                                    <td><?php echo htmlspecialchars($row['EndTime']); ?></td>
                                    <td><?php echo $row['Progress'] == 1 ? 'In Progress' : 'Completed'; ?></td>
                                    <td>
                                        <?php if ($row['Progress'] == 1): ?>
                                            <a href="/cleaner/edit.php?id=<?php echo $row['Id']; ?>" class="btn btn-primary">Edit</a>
                                        <?php endif; ?>
                                        <a href="/service_records/view.php?id=<?php echo $row['Id']; ?>" class="btn btn-secondary">View</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No cleaning records found.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php
            // Free result set
            $result->free();
        ?>
    </div>
</body>
</html>
