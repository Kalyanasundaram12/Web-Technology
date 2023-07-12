<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "mydb";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS cart (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(50) NOT NULL,
    quantity INT(6) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'cart' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item1_quantity = isset($_POST["item1_quantity"]) ? $_POST["item1_quantity"] : 0;
    $item2_quantity = isset($_POST["item2_quantity"]) ? $_POST["item2_quantity"] : 0;
    $item3_quantity = isset($_POST["item3_quantity"]) ? $_POST["item3_quantity"] : 0;
    $item4_quantity = isset($_POST["item4_quantity"]) ? $_POST["item4_quantity"] : 0;
    $item5_quantity = isset($_POST["item5_quantity"]) ? $_POST["item5_quantity"] : 0;

    $sql = "INSERT INTO cart (item_name, quantity) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $item_name, $quantity);

    $item_name = "Apple Ipad";
    $quantity = $item1_quantity;
    mysqli_stmt_execute($stmt);


    $item_name = "Apple Iphone";
    $quantity = $item2_quantity;
    mysqli_stmt_execute($stmt);


    $item_name = "Apple Airpods";
    $quantity = $item3_quantity;
    mysqli_stmt_execute($stmt);


    $item_name = "Apple Ipod";
    $quantity = $item4_quantity;
    mysqli_stmt_execute($stmt);

    $item_name = "Apple Iwatch";
    $quantity = $item5_quantity;
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
