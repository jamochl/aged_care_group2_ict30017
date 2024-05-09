<!DOCTYPE html>
<html>
<head>
    <title>View Service Records</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Service Records</h1>
    <!-- Display service records here -->
    <div id="serviceRecords"></div>

    <script>
        // disply records
        function fetchServiceRecords() {
            $.ajax({
                url: 'fetchServiceRecords.php',
                success: function(data) {
                    $('#serviceRecords').html(data);
                }
            });
        }

        // refresh every 5 secs
        setInterval(fetchServiceRecords, 5000);

        // trigger PHP script to move expired records
        $.ajax({
            url: 'moveExpiredRecords.php',
            success: function(response) {
                console.log(response);
            }
        });
    </script>
</body>
</html>
