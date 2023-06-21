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

    // Update item in the database
    $sql = "UPDATE products SET product_name='$product_name', price='$price', stock='$stock' WHERE product_id='$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo"Item updated successfully";
        exit;
    } else {
        echo '<div class="error">Error updating item: ' . $conn->error . '</div>';
    }

    $conn->close();
?>
