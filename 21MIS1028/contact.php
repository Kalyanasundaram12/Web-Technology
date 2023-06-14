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
?>
