<?php include 'config.php'; ?>
<?php
    $staffName = $_SESSION["staffname"]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .body{
            margin: 0%;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        /* Style the active/current link */
        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }
        /* Logout button styles */
        .logout-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php
        // Check if there is an error message and the requested page in the session variables
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
        $page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : '';

        // Display error message if present
        if ($error === 'unauthorized' && !empty($page)) {
            echo '<div class="alert alert-danger" role="alert">You are not authorized to access the page: ' . htmlspecialchars($page) . '</div>';
        }

        // Unset session variables
        unset($_SESSION['error']);
        unset($_SESSION['requested_page']);
        ?>
        <div class="container my-5">
            <h1>Aged Care Management Software</h1>
            <div class="d-flex justify-content-between">
                <h2>Welcome, <?=$staffName?>!</h2>
                <form method="post">
                    <input class="btn btn-danger" type="submit" name="logout" value="Logout">
                </form>
            </div>
        </div>
        <!-- Everything but accountant -->
        <?php if ($_SESSION['role'] != 4): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <div class="col">
                <a href="/rosters/my.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Rosters and Availability</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/service_records/my.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Services Records</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif?>
        <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1): ?>
        <!-- Admin and carers -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <?php if ($_SESSION['role'] == 2): ?>
            <div class="col">
                <a href="/members/my.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Member Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif?>
            <div class="col">
                <a href="/members/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Member Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Admin only -->
            <?php if ($_SESSION['role'] == 1): ?>
            <div class="col">
                <a href="/staff/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Staff Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif?>
        </div>
        <?php endif?>
        <?php if ($_SESSION['role'] == 1): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <div class="col">
                <a href="/rosters/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Rosters and availability</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Admin only -->
            <div class="col">
                <a href="/service_records/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Services Records</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif?>
        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <!-- Admin and cleaners -->
            <div class="col">
                <a href="/room/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Rooms and bookings</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/cleaner/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Cleaning Status</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif?>
        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2): ?>
            <!-- Admin and carers -->
            <div class="col">
                <a href="/inventory/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Inventory</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif?>
        <!-- Accountants and admins -->
        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <div class="col">
                <a href="/billing/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Billing</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif?>
        <!-- everybody -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
            <div class="col">
                <a href="/docs/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Documentation</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Add more Admin specific content here -->
        </div>
    </div>
</body>


</html>
