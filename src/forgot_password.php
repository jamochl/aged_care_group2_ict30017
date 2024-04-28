<?php
include 'config.php';

// Initialize error message variable
$error_msg = '';
$success_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username, new password, and confirm password
    $username = $_POST["username"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $error_msg = "Passwords do not match.";
    } else {
        // Update password in the database (you need to implement your update logic here)
        // For this example, we'll just show a success message
        $success_msg = "Password updated successfully.";

        // Redirect back to login page after 3 seconds
        header("refresh:3;url=login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Password Reset</h2>
        <?php if (!empty($success_msg)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_msg; ?>
            </div>
        <?php else : ?>
            <form method="post" action="#">
                <div class="mb-3">
                    <label for="Username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" >
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
            <?php if (!empty($error_msg)) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>

