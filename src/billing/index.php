<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Summary</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Financial Summary</h2>

        <div>
            <!-- Display existing reports -->
            <h3>Existing Reports</h3>
            <ul>
                <?php
                // Fetch existing reports from the database
                $report_query = "SELECT * FROM BillingReports";
                $report_result = $mysqli->query($report_query);

                if ($report_result->num_rows > 0) {
                    echo "<ul>";
                    while ($report_row = $report_result->fetch_assoc()) {
                        $report_id = $report_row['Id'];
                        $start_time = $report_row['StartTime'];
                        $end_time = $report_row['EndTime'];
                        // Add link for each report
                        echo "<li><a href='view.php?report_id=$report_id'>Report Period: $start_time - $end_time</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No billing reports found.</p>";
                }
                ?>
            </ul>
        </div>

        <div>
            <!-- Generate new report form -->
            <h3>Generate New Report</h3>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="mb-3">
                    <label for="time_period" class="form-label">Select Time Period:</label>
                    <select id="time_period" name="time_period" class="form-select">
                        <option value="quarter">Quarterly</option>
                        <option value="months">Specific Months</option>
                    </select>
                </div>
                
                <!-- Add more form elements based on user selection -->
                
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate form input
            if (isset($_POST['time_period'])) {
                $time_period = $_POST['time_period'];
                if ($time_period == "quarter") {
                    // Handle quarter selection
                    // Validate and process the selected quarter
                } elseif ($time_period == "months") {
                    // Handle month selection
                    // Validate and process the selected months
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Invalid time period</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Time period is required</div>";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
