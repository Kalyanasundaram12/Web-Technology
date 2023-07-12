<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (name, email, password, address) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $address);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "User registered successfully.";
} else {
    echo "User registration failed.";
}

$stmt->close();
$conn->close();
?>
