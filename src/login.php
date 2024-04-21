<?php include 'config.php'; ?>
<?php
// Initialize error message variable
$error_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION["role"])) {
        header("Location: /home.php");
        exit;
    }
}

// Check forms are submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve name and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL statement to retrieve username
    $sql = "SELECT * FROM Staff WHERE Name = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check username exists in the table
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $actual_pass = $row["PasswordHash"];

        // Verify password
        if ($password == $actual_pass) {
            // Set user role
            $_SESSION["role"] = $row["RoleId"];
            $_SESSION["staffid"] = $row["Id"];

            // Redirect only if there are no error messages
            if (empty($error_msg)) {
                header("Location: /home.php");
                exit;
            }
        } else {
            $error_msg = "Incorrect password";
        }
    } else {
        $error_msg = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        <?php if (!empty($error_msg)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_msg; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="#">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
