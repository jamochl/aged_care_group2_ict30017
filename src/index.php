<?php
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Create mysqli connection
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check forms are submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve name and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL statement to retrieve username
    $sql = "SELECT * FROM Staff WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check username exists in the table
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $actual_pass = $row["PasswordHash"];

        // Verify password
        // if ($password === $actual_pass) 

        $hashedPWD = password_hash($actual_pass, PASSWORD_DEFAULT);
        if (password_verify($password, $hashedPWD)) {

            // Start the session and set user role
            session_start();
            $_SESSION["role"] = $row["RoleId"];
            $_SESSION["staffid"] = $row["Id"];

            // Redirect users based on their roles
            switch ($_SESSION["role"]) {
                case 1:
                    header("Location: admin_home.php");
                    break;
                case 2:
                    header("Location: carer_home.php");
                    break;
                case 3:
                    header("Location: cleaner_home.php");
                    break;
                case 4:
                    header("Location: accountant_home.php");
                    break;
                default:
                    echo "Invalid role";
            }
            exit;
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
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
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
