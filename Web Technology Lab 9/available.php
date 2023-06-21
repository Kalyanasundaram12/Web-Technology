<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h1 {
        margin-top: 0;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    td {
        background-color: #fff;
        color: #333;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    tr:hover td {
        background-color: #e5e5e5;
    }
</style>

</head>
<body>
    <h1>Available Items</h1>

    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
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

            // Fetch items from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["product_id"]."</td>";
                    echo "<td>".$row["product_name"]."</td>";
                    echo "<td>".$row["price"]."</td>";
                    echo "<td>".$row["stock"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No items found.</td></tr>";
            }

            $conn->close();
        ?>
    </table>
</body>
</html>
