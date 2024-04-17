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
    </style>
</head>

<body>
    <div class="container mt-5">
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
