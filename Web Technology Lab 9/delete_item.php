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

    // Delete item from the database
    $sql = "DELETE FROM products WHERE product_id='$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo"Item deleted successfully";
        exit;
    } else {
        echo '<div class="error">Error deleting item: ' . $conn->error . '</div>';
    }

    $conn->close();
?>
