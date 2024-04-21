<?php
session_start();
if (!isset($_SESSION['role']) && strpos($_SERVER['REQUEST_URI'] , 'login') === false) {
    header("Location: /login.php");
}
// Check if the user clicked on the logout button
if(isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header("Location: /login.php");
    exit;
}
// Function to generate breadcrumbs
function generateBreadcrumbs() {
    // Get the current URL path
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = explode('/', $url);
    $breadcrumbs = array_filter($urlParts);

    // Create breadcrumbs array
    $breadcrumbsArray = [];
    $breadcrumbPath = '';

    foreach ($breadcrumbs as $breadcrumb) {
        $breadcrumbPath .= '/' . $breadcrumb;
        $breadcrumbsArray[] = "<a href='$breadcrumbPath'>$breadcrumb</a>";
    }

    // Output breadcrumbs
    echo implode(' / ', $breadcrumbsArray);
}

// Database connection parameters
$host = "db";
$port = "3306";
$user = "admin";
$password = "admin";
$database = "aged_care";

// Create mysqli connection
$mysqli = new mysqli($host, $user, $password, $database, $port);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>
