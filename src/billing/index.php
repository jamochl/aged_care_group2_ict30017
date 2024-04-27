<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form input
    if (isset($_POST['time_period'])) {
        $time_period = $_POST['time_period'];
        $start_month = $_POST['start_month'];
        $end_month = $_POST['end_month'];
        $current_year = date("Y");

        if ($time_period == "months") {
            // Insert the report into the database
            $stmt = $mysqli->prepare("INSERT INTO BillingReports (StartTime, EndTime, TransactionType) VALUES (?, ?, ?)");
            $start_date = date('Y-m-d', strtotime("$start_month-01"));
            $end_date = date('Y-m-d', strtotime("$end_month-01"));
            $transaction_type = "Monthly Report";
            $stmt->bind_param("sss", $start_date, $end_date, $transaction_type);

            if ($stmt->execute()) {
                $report_id = $stmt->insert_id; // Get the ID of the inserted report
                echo "<div class='alert alert-success' role='alert'>Report generated successfully and saved to the database. <a href='view.php?report_id=$report_id'>Link</a></div>";
                
                // Retrieve all active members
                $active_member_query = "SELECT Id, DateJoined, BillingPerYear FROM Members WHERE IsStillMember = 1";
                $active_member_result = $mysqli->query($active_member_query);

                // Loop through each active member
                while ($member_row = $active_member_result->fetch_assoc()) {
                    $member_id = $member_row['Id'];
                    $join_date = strtotime($member_row['DateJoined']);
                    $billing_per_year = $member_row['BillingPerYear'];

                    // Calculate the number of active months for the member
                    $start_date_timestamp = strtotime($start_month);
                    $end_date_timestamp = strtotime($end_month);
                    $active_months = 0;
                    for ($i = $start_date_timestamp; $i <= $end_date_timestamp; $i = strtotime("+1 month", $i)) {
                        if ($join_date <= $i) {
                            $active_months++;
                        }
                    }

                    // Calculate the billing amount for the member
                    $billing_amount = ($active_months / 12) * $billing_per_year;

                    // Insert billing item into the database
                    $stmt = $mysqli->prepare("INSERT INTO BillingItem (BillingReportId, MemberId, Amount) VALUES (?, ?, ?)");
                    $stmt->bind_param("iid", $report_id, $member_id, $billing_amount);
                    if (! $stmt->execute()) {
                        echo "<div class='alert alert-danger' role='alert'>Error generating billing item for member ID $member_id: " . $stmt->error . "</div>";
                    }
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error generating report: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid time period</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Time period is required</div>";
    }
}
?>

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
        <div>
            <!-- Display the generated breadcrumbs -->
            <?php generateBreadcrumbs(); ?>
        </div>
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
                        $start_time = date('Y-m', strtotime($report_row['StartTime']));
                        $end_time = date('Y-m', strtotime($report_row['EndTime']));
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
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="time_period" class="form-label">Select Time Period:</label>
                    <select id="time_period" name="time_period" class="form-select">
                        <option value="months">Specific Time Period</option>
                    </select>
                </div>
                <div id="monthly" class="mb-3">
                    <label for="start_month" class="form-label">Start Month:</label>
                    <input type="month" id="start_month" name="start_month" class="form-control" value="<?= date('Y-m'); ?>">
                    <label for="end_month" class="form-label">End Month:</label>
                    <input type="month" id="end_month" name="end_month" class="form-control" value="<?= date('Y-m'); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
