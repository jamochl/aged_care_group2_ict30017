<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Report Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Billing Report Detail</h2>

        <?php
        // Check if report ID is provided
        if (isset($_GET['report_id'])) {
            $report_id = $_GET['report_id'];

            // Retrieve billing report details from the database
            $report_query = "SELECT * FROM BillingReports WHERE Id = $report_id";
            $report_result = $mysqli->query($report_query);

            if ($report_result->num_rows > 0) {
                $report_row = $report_result->fetch_assoc();
                $start_time = $report_row['StartTime'];
                $end_time = $report_row['EndTime'];

                // Retrieve billing items associated with the report
                $billing_item_query = "SELECT * FROM BillingItem WHERE BillingReportId = $report_id";
                $billing_item_result = $mysqli->query($billing_item_query);

                if ($billing_item_result->num_rows > 0) {
                    echo "<h3>Report Period: $start_time - $end_time</h3>";

                    // Display billing items in a table
                    echo "<table class='table'>";
                    echo "<thead><tr><th>Member</th><th>Amount</th></tr></thead>";
                    echo "<tbody>";
                    while ($billing_item_row = $billing_item_result->fetch_assoc()) {
                        $member_id = $billing_item_row['MemberId'];
                        $amount = $billing_item_row['Amount'];

                        // Retrieve member details from the database
                        $member_query = "SELECT * FROM Members WHERE Id = $member_id";
                        $member_result = $mysqli->query($member_query);

                        if ($member_result->num_rows > 0) {
                            $member_row = $member_result->fetch_assoc();
                            $member_name = $member_row['FirstName'] . ' ' . $member_row['LastName'];

                            // Display member details in a table row
                            echo "<tr><td>$member_name</td><td>$amount</td></tr>";
                        }
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>No billing items found for this report.</p>";
                }
            } else {
                echo "<p>Billing report not found.</p>";
            }
        } else {
            echo "<p>Report ID is missing.</p>";
        }
        ?>

        <a href="index.php" class="btn btn-secondary">Back to Reports</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
