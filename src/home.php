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
        <div class="container my-5">
            <div class="d-flex justify-content-between">
                <h1>Welcome, <?=$staffName?>!</h1>
                <form method="post">
                    <input class="btn btn-danger" type="submit" name="logout" value="Logout">
                </form>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php if ($_SESSION['role'] == 2): ?>
            <!-- Carer Dashboard -->
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
                <a href="/members/my.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Members</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/members" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Member Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/inventory" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Inventory</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Add more Carer specific content here -->
            <?php elseif ($_SESSION['role'] == 3): ?>
            <!-- Cleaner Dashboard -->
            <div class="col">
                <a href="/rosters/my.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Rosters and Availability</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Add more Cleaner specific content here -->
            <?php elseif ($_SESSION['role'] == 4): ?>
            <!-- Accountant Dashboard -->
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
                <a href="/invoices/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Invoices</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Add more Accountant specific content here -->
            <?php else: ?>
            <!-- Default Dashboard for Admin or other roles -->
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
                <a href="/members/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Member Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/staff/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Staff Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/rosters/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Rosters and availability</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/room/index.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Rooms</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/inventory" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Inventory</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Add more Admin specific content here -->
            <?php endif; ?>
        </div>
    </div>
</body>


</html>
