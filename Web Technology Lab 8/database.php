<?php

$name = $_POST["name"] ?? "";
    $address = $_POST["address"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $mobile = $_POST["mobile"] ?? "";
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($name) || empty($address) || empty($dob) || empty($mobile) || 
    empty($email) || empty($username) || empty($password)) {
    die("Error: All input fields are required");
    }

    if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
    die("Error: Name must consist of only alphabets and white spaces");
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
    die("Error: Mobile number must consist of 10 digits only");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address");
    }

    if (strlen($password) < 8 || strlen($password) > 20) {
    die("Error: Password length should be between 8 and 20");
    }
    
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'insurance_form';

$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Step 2: Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$name = mysqli_real_escape_string($connection, $name);
$address = mysqli_real_escape_string($connection, $address);

$query = "INSERT INTO clients (name, address, dob, mobile, email, username, password)
          VALUES ('$name', '$address', '$dob', '$mobile', '$email', '$username', '$password')";

$result = mysqli_query($connection, $query);
if ($result) {
    echo "Data successfully stored in the database.";
} else {
    echo "Error: " . mysqli_error($connection);
}


mysqli_close($connection);
?>
