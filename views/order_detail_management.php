<?php

// Include the OrderDetail class
require_once('../classes/OrderDetail.php');

// Initialize OrderDetail object
$orderDetail = new OrderDetail();

// Check if form is submitted for adding or updating an order detail
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        // Add new order detail
        $detail_id_order = $_POST['detail_id_order'];
        $detail_id_produk = $_POST['detail_id_produk'];
        $detail_harga = $_POST['detail_harga'];
        $detail_jml = $_POST['detail_jml'];
        $orderDetail->insertOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml);
    } elseif ($_POST['submit'] == 'update') {
        // Update order detail
        $detail_id_order = $_POST['detail_id_order'];
        $detail_id_produk = $_POST['detail_id_produk'];
        $detail_harga = $_POST['detail_harga'];
        $detail_jml = $_POST['detail_jml'];
        $orderDetail->updateOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml);
    }
}

// Check if delete button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_order']) && isset($_GET['id_produk'])) {
    $detail_id_order = $_GET['id_order'];
    $detail_id_produk = $_GET['id_produk'];
    $orderDetail->deleteOrderDetail($detail_id_order, $detail_id_produk);
}

// Fetch all order details
$orderDetails = $orderDetail->getAllOrderDetails();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
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
            background-color: #f2f2f2;
        }
        td a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Order Detail Management</h1>

    <!-- Form for adding or updating an order detail -->
    <form action="order_detail_management.php" method="post">
        <label for="detail_id_order">Order ID:</label><br>
        <input type="text" id="detail_id_order" name="detail_id_order"><br>
        <label for="detail_id_produk">Product ID:</label><br>
        <input type="text" id="detail_id_produk" name="detail_id_produk"><br>
        <label for="detail_harga">Harga:</label><br>
        <input type="text" id="detail_harga" name="detail_harga"><br>
        <label for="detail_jml">Jumlah:</label><br>
        <input type="text" id="detail_jml" name="detail_jml"><br>
        <input type="submit" name="submit" value="add">
    </form>

    <br>

    <!-- List of order details -->
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Product ID</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orderDetails as $orderDetail): ?>
        <tr>
            <td><?php echo $orderDetail['detail_id_order']; ?></td>
            <td><?php echo $orderDetail['detail_id_produk']; ?></td>
            <td><?php echo $orderDetail['detail_harga']; ?></td>
            <td><?php echo $orderDetail['detail_jml']; ?></td>
            <td>
                <a href="order_detail_management.php?action=edit&id_order=<?php echo $orderDetail['detail_id_order']; ?>&id_produk=<?php echo $orderDetail['detail_id_produk']; ?>">Edit</a>
                <a href="order_detail_management.php?action=delete&id_order=<?php echo $orderDetail['detail_id_order']; ?>&id_produk=<?php echo $orderDetail['detail_id_produk']; ?>" onclick="return confirm('Are you sure you want to delete this order detail?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
