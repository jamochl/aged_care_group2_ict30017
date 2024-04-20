<?php

// Start session to access the user
session_start();

// Checks that user is logged in and is an admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 2) {
    // If not logged in then redirect back to login
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    // Unset all sessions variables
    $_SESSION = array();

    // Destroy session
    session_destroy();

    // Redirect to the login page 
    header("Location: index.php");
    exit;
}

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
        .card-link {
            text-decoration: none;
            color: inherit;
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

    </style>
</head>

<body>

    

    <div class="container mt-5">

            <!-- Log out button  -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <button class="logout-button" type="submit" name="logout">Log out</button>
            </form>

        <h1>Welcome to Staff Home</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <a href="my_rosters.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Rosters and Availability</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="my_members.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">My Members</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="all_members.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">All Member Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="inventory.php" class="card-link">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Inventory</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
