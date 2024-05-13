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
    $breadcrumbsArray = ['<li class="breadcrumb-item"><a href="/home">Home</a></li>'];
    $breadcrumbPath = '';

    foreach ($breadcrumbs as $breadcrumb) {
        if ($breadcrumb != "index") {
            $breadcrumbPath .= '/' . $breadcrumb;
            $breadcrumbsArray[] = "<li class='breadcrumb-item'><a href='$breadcrumbPath'>$breadcrumb</a></li>";
        }
    }

    // Output breadcrumbs
    echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">' . implode(' ', $breadcrumbsArray) . '</ol></nav>';
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

// Define authorized pages based on roles
$authorizedPages = [
    // Carer
    "2" => [
        '/rosters/my*',
        '/availabilities/*',
        '/service_records/*',
        '/inventory/*',
        '/members/*',
        '/docs/*',
        '/room/*'
    ],
    // Cleaner
    "3" => [
        '/rosters/my*',
        '/cleaner/*',
        '/availabilities/*',
        '/service_records/*',
        '/docs/*',
        '/room/*'
    ],
    // Accountant
    "4" => [
        '/docs/*',
        '/billing/*'
    ]
];

// Check if the current page is authorized for the user's role
function isAuthorized($role, $page)
{
    global $authorizedPages;
    if (fnmatch("/home*", $page)) {
        return true;
    }

    foreach ($authorizedPages[$role] as $authorizedPage) {
        if (fnmatch($authorizedPage, $page)) {
            return true;
        }
    }

    return false;
}

// Get the current page URL
$current_page = $_SERVER['REQUEST_URI'];

// Get user role
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Check if the user's role is authorized to access the current page (if not admin)
if ($role !== '' && $role !== 1 && !isAuthorized($role, $current_page)) {
    // Get the current URL path
    $url = $_SERVER['REQUEST_URI'];
    // Redirect unauthorized users to home page with error message including the requested page
    $_SESSION['error'] = 'unauthorized';
    $_SESSION['requested_page'] = $url;
    header("Location: /home");
    exit;
}
?>
