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
    // Retrive name and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL statement to retrive username
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
        if(password_verify($password, $hashedPWD)) {

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
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>