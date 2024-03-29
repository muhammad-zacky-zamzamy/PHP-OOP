<?php

// Include the Users class
require_once('../classes/Users.php');

// Initialize Users object
$users = new Users();

// Check if form is submitted for adding or updating a user
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        // Add new user
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_nama = $_POST['user_nama'];
        $user_alamat = $_POST['user_alamat'];
        $user_hp = $_POST['user_hp'];
        $user_usia = $_POST['user_usia'];
        $user_role = $_POST['user_role'];
        $user_aktif = $_POST['user_aktif'];
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $users->insertUser($user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $created_at, $updated_at);
    } elseif ($_POST['submit'] == 'update') {
        // Update user
        $user_id = $_POST['user_id'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_nama = $_POST['user_nama'];
        $user_alamat = $_POST['user_alamat'];
        $user_hp = $_POST['user_hp'];
        $user_usia = $_POST['user_usia'];
        $user_role = $_POST['user_role'];
        $user_aktif = $_POST['user_aktif'];
        $updated_at = date('Y-m-d H:i:s');
        $users->updateUser($user_id, $user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $updated_at);
    }
}

// Check if delete button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $users->deleteUser($user_id);
}

// Check if edit button is clicked and fetch user data
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $user = $users->getUserById($user_id);
}

// Fetch all users
$allUsers = $users->getAllUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
        input[type="text"],
        input[type="password"] {
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
    <h1>User Management</h1>

    <!-- Form for adding or updating a user -->
    <form action="user_management.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo isset($user) ? $user['user_id'] : ''; ?>">
        <label for="user_email">Email:</label><br>
        <input type="text" id="user_email" name="user_email" value="<?php echo isset($user) ? $user['user_email'] : ''; ?>"><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" value="<?php echo isset($user) ? $user['user_password'] : ''; ?>"><br>
        <label for="user_nama">Nama:</label><br>
        <input type="text" id="user_nama" name="user_nama" value="<?php echo isset($user) ? $user['user_nama'] : ''; ?>"><br>
        <label for="user_alamat">Alamat:</label><br>
        <input type="text" id="user_alamat" name="user_alamat" value="<?php echo isset($user) ? $user['user_alamat'] : ''; ?>"><br>
        <label for="user_hp">Nomor HP:</label><br>
        <input type="text" id="user_hp" name="user_hp" value="<?php echo isset($user) ? $user['user_hp'] : ''; ?>"><br>
        <label for="user_usia">Usia:</label><br>
        <input type="text" id="user_usia" name="user_usia" value="<?php echo isset($user) ? $user['user_usia'] : ''; ?>"><br>
        <label for="user_role">Role:</label><br>
        <input type="text" id="user_role" name="user_role" value="<?php echo isset($user) ? $user['user_role'] : ''; ?>"><br>
        <label for="user_aktif">Aktif:</label><br>
        <input type="text" id="user_aktif" name="user_aktif" value="<?php echo isset($user) ? $user['user_aktif'] : ''; ?>"><br>
        <input type="submit" name="submit" value="<?php echo isset($user) ? 'update' : 'add'; ?>">
    </form>

    <br>

    <!-- List of users -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Usia</th>
            <th>Role</th>
            <th>Aktif</th>
            <th>Action</th>
        </tr>
        <?php foreach ($allUsers as $user): ?>
        <tr>
            <td><?php echo $user['user_id']; ?></td>
            <td><?php echo $user['user_email']; ?></td>
            <td><?php echo $user['user_nama']; ?></td>
            <td><?php echo $user['user_alamat']; ?></td>
            <td><?php echo $user['user_hp']; ?></td>
            <td><?php echo $user['user_usia']; ?></td>
            <td><?php echo $user['user_role']; ?></td>
            <td><?php echo $user['user_aktif']; ?></td>
            <td>
                <a href="user_management.php?action=edit&id=<?php echo $user['user_id']; ?>">Edit</a>
                <a href="user_management.php?action=delete&id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
