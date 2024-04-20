<?php
    // Database connection parameters
    $host = "db";
    $port = "3306";
    $user = "admin";
    $password = "admin";
    $database = "aged_care";

    // Connect to the database
    $mysqli = new mysqli($host, $user, $password, $database, $port);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $passwordHash = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];
        $nationality = $_POST['nationality'];
        $birthDate = $_POST['birthDate'];
    
        if ($role == "Admin") {
            $roleID = 1;
        } elseif ($role == "Staff") {
            $roleID = 2;
        } elseif ($role == "Cleaner") {
            $roleID = 3;
        } elseif ($role == "Account"){
            $roleID = 4;
        }
        $sql = "INSERT INTO Staff (Name, PasswordHash, Contact, BirthDate, Nationality, PhoneNumber, RoleId) VALUES ('$name', '$passwordHash', '$email', '$birthDate', '$nationality', '$phone', '$roleID')";
        if ($mysqli->query($sql) === true) {
            echo "New employee created successfully";
        } else {
            echo "Failed to collect data from MySQL: " . $mysqli->connect_error;
            exit();
        }
    }

?>