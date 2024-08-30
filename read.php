<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Product Lists</h1>
    <table id="productsTable" class="display" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db.php';

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['created_at']}</td>
                            <td>{$row['updated_at']}</td>
                            <td>
                                <a href='update.php?id={$row['id']}'>Edit</a> | 
                                <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                            </td>
                             </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No products found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <a href="index.php" class="button"style ="border: 2px solid black; text-decoration: none; mt:10px;">Add Products</a>

</body>
</html>