<?php

// Include the Keranjang class
require_once('../classes/Keranjang.php');

// Initialize Keranjang object
$keranjang = new Keranjang();

// Check if form is submitted for adding an item to the cart
if (isset($_POST['submit']) && $_POST['submit'] == 'add') {
    // Add new item to the cart
    $ker_id_user = $_POST['ker_id_user'];
    $ker_id_produk = $_POST['ker_id_produk'];
    $ker_harga = $_POST['ker_harga'];
    $ker_jml = $_POST['ker_jml'];
    $keranjang->addToCart($ker_id_user, $ker_id_produk, $ker_harga, $ker_jml);
}

// Check if form is submitted for updating an item in the cart
if (isset($_POST['submit']) && $_POST['submit'] == 'update') {
    // Update item in the cart
    $ker_id = $_POST['ker_id'];
    $ker_harga = $_POST['ker_harga'];
    $ker_jml = $_POST['ker_jml'];
    $keranjang->updateCartItem($ker_id, $ker_jml, $ker_harga);
}

// Check if delete button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $ker_id = $_GET['id'];
    $keranjang->removeFromCart($ker_id);
}

// Fetch all items in the cart
$user_id = 1; // Assuming user ID 1 is currently logged in
$cart_items = $keranjang->getUserCart($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        .delete-link {
            background-color: #f44336;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        input[type="submit"]:hover,
        .delete-link:hover {
            background-color: #d32f2f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Keranjang Management</h1>

    <!-- Form for adding an item to the cart -->
    <form action="keranjang_management.php" method="post">
        <input type="hidden" name="ker_id_user" value="<?php echo $user_id; ?>">
        <label for="ker_id_produk">Product ID:</label><br>
        <input type="text" id="ker_id_produk" name="ker_id_produk"><br>
        <label for="ker_harga">Harga:</label><br>
        <input type="text" id="ker_harga" name="ker_harga"><br>
        <label for="ker_jml">Jumlah:</label><br>
        <input type="text" id="ker_jml" name="ker_jml"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <br>

    <!-- List of items in the cart -->
    <table border="1">
        <tr>
            <th>Keranjang ID</th>
            <th>User ID</th>
            <th>Product ID</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cart_items as $item): ?>
        <tr>
            <td><?php echo $item['ker_id']; ?></td>
            <td><?php echo $item['ker_id_user']; ?></td>
            <td><?php echo $item['ker_id_produk']; ?></td>
            <td><?php echo $item['ker_harga']; ?></td>
            <td><?php echo $item['ker_jml']; ?></td>
            <td>
                <!-- Form for updating an item in the cart -->
                <form action="keranjang_management.php" method="post">
                    <input type="hidden" name="ker_id" value="<?php echo $item['ker_id']; ?>">
                    <label for="ker_harga">Harga:</label>
                    <input type="text" name="ker_jml" value="<?php echo $item['ker_jml']; ?>">
                    <label for="ker_jml">Jumlah:</label>
                    <input type="text" name="ker_harga" value="<?php echo $item['ker_harga']; ?>">
                    <input type="submit" name="submit" value="update">
                </form>
                <!-- Delete button for removing an item from the cart -->
                <a class="delete-link" href="keranjang_management.php?action=delete&id=<?php echo $item['ker_id']; ?>" onclick="return confirm('Are you sure you want to delete this item from your cart?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
