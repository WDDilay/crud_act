<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];


    $sql = "UPDATE products SET 
                name='$name', 
                description='$description', 
                price='$price', 
                quantity='$quantity', 
                updated_at=NOW() 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: read.php"); 
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h1>Update Product</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo $row['description']; ?></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
