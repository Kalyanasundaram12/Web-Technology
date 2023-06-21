<?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "addtocart";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    // Insert item into the database
    $sql = "INSERT INTO products (product_id, product_name, price, stock) VALUES ('$product_id', '$product_name', '$price', '$stock')";

    if ($conn->query($sql) === TRUE) {
        echo"Item added successfully";
        exit;
    } else {
        echo '<div class="error">Error adding item: ' . $conn->error . '</div>';
    }

    $conn->close();
?>
