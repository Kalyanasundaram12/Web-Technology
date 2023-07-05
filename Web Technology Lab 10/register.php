<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'addtocart');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the Users table needs modification
$checkSql = "SHOW KEYS FROM Users WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($result) === 0) {
  // Alter Users table to make id auto-incrementing
  $alterSql = "ALTER TABLE Users MODIFY COLUMN id INT AUTO_INCREMENT PRIMARY KEY";
  mysqli_query($conn, $alterSql);
}

// Process registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Insert user into Users table
  $sql = "INSERT INTO users (username, password, created_at) VALUES ('$username', '$password', NOW())";
  if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
