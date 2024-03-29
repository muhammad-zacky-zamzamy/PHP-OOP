<?php

require_once('../classes/Order.php');

$order = new Order();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == 'add') {
            $order_id_user = $_POST['order_id_user'];
            $order_kode = htmlspecialchars($_POST['order_kode']);
            $order_ttl = $_POST['order_ttl'];
            $order_ongkir = $_POST['order_ongkir'];
            $order_byr_deadline = $_POST['order_byr_deadline'];
            $updated_at = date('Y-m-d H:i:s');
            $created_at = date('Y-m-d H:i:s');
            $order->insertOrder($order_id_user, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $created_at, $updated_at);
        } elseif ($_POST['submit'] == 'update') {
            $order_id = $_POST['order_id'];
            $order_id_user = $_POST['order_id_user'];
            $order_kode = htmlspecialchars($_POST['order_kode']);
            $order_ttl = $_POST['order_ttl'];
            $order_ongkir = $_POST['order_ongkir'];
            $order_byr_deadline = $_POST['order_byr_deadline'];
            $updated_at = date('Y-m-d H:i:s');
            $order->updateOrder($order_id, $order_id_user, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, null, $updated_at);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $order_id = $_GET['id'];
        $order->deleteOrder($order_id);
    } elseif (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
        $order_id = $_GET['id'];
        $order_data = $order->getOrderById($order_id);
    }
}

$orders = $order->getAllOrders();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
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
    <h1>Order Management</h1>

    <!-- Form for adding or updating an order -->
    <form action="order_management.php" method="post">
        <input type="hidden" name="order_id" value="<?php echo isset($order_data) ? $order_data['order_id'] : ''; ?>">
        <input type="hidden" name="order_id_user" value="1"> <!-- Assuming user ID is hardcoded for simplicity -->
        <label for="order_kode">Order Kode:</label><br>
        <input type="text" id="order_kode" name="order_kode" value="<?php echo isset($order_data) ? $order_data['order_kode'] : ''; ?>"><br>
        <label for="order_ttl">Order Total:</label><br>
        <input type="text" id="order_ttl" name="order_ttl" value="<?php echo isset($order_data) ? $order_data['order_ttl'] : ''; ?>"><br>
        <label for="order_ongkir">Order Ongkir:</label><br>
        <input type="text" id="order_ongkir" name="order_ongkir" value="<?php echo isset($order_data) ? $order_data['order_ongkir'] : ''; ?>"><br>
        <label for="order_byr_deadline">Order Payment Deadline:</label><br>
        <input type="text" id="order_byr_deadline" name="order_byr_deadline" value="<?php echo isset($order_data) ? $order_data['order_byr_deadline'] : ''; ?>"><br>
        <input type="submit" name="submit" value="<?php echo isset($order_data) ? 'update' : 'add'; ?>">
    </form>

    <br>

    <!-- List of orders -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Order Kode</th>
            <th>Order Total</th>
            <th>Order Ongkir</th>
            <th>Order Payment Deadline</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['order_kode']; ?></td>
            <td><?php echo $order['order_ttl']; ?></td>
            <td><?php echo $order['order_ongkir']; ?></td>
            <td><?php echo $order['order_byr_deadline']; ?></td>
            <td>
                <a href="order_management.php?action=edit&id=<?php echo $order['order_id']; ?>">Edit</a>
                <a href="order_management.php?action=delete&id=<?php echo $order['order_id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
