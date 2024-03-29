<?php

// Include the Produk class
require_once('../classes/Produk.php');

// Initialize Produk object
$produk = new Produk();

// Check if form is submitted for adding or updating a product
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        // Add new product
        $produk_id_kat = $_POST['produk_id_kat'];
        $produk_id_user = $_POST['produk_id_user'];
        $produk_kode = $_POST['produk_kode'];
        $produk_nama = $_POST['produk_nama'];
        $produk_hrg = $_POST['produk_hrg'];
        $produk_keterangan = $_POST['produk_keterangan'];
        $produk_stock = $_POST['produk_stock'];
        $produk_photo = $_POST['produk_photo'];
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $produk->insertProduk($produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at);
    } elseif ($_POST['submit'] == 'update') {
        // Update product
        $produk_id = $_POST['produk_id'];
        $produk_id_kat = $_POST['produk_id_kat'];
        $produk_id_user = $_POST['produk_id_user'];
        $produk_kode = $_POST['produk_kode'];
        $produk_nama = $_POST['produk_nama'];
        $produk_hrg = $_POST['produk_hrg'];
        $produk_keterangan = $_POST['produk_keterangan'];
        $produk_stock = $_POST['produk_stock'];
        $produk_photo = $_POST['produk_photo'];
        $updated_at = date('Y-m-d H:i:s');
        $produk->updateProduk($produk_id, $produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at);
    }
}

// Check if delete button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $produk_id = $_GET['id'];
    $produk->deleteProduk($produk_id);
}

// Fetch all products
$products = $produk->getAllProduk();

// Check if edit button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_produk = $produk->getProdukById($_GET['id']); // Inisialisasi $edit_produk
    $edit_produk_id = $edit_produk['produk_id'];
    $edit_produk_id_kat = $edit_produk['produk_id_kat'];
    $edit_produk_id_user = $edit_produk['produk_id_user'];
    $edit_produk_kode = $edit_produk['produk_kode'];
    $edit_produk_nama = $edit_produk['produk_nama'];
    $edit_produk_hrg = $edit_produk['produk_hrg'];
    $edit_produk_keterangan = $edit_produk['produk_keterangan'];
    $edit_produk_stock = $edit_produk['produk_stock'];
    $edit_produk_photo = $edit_produk['produk_photo'];
    $edit_updated_at = isset($edit_produk['updated_at']) ? date('Y-m-d H:i:s', strtotime($edit_produk['updated_at'])) : ''; // Perbaiki pengambilan updated_at
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Management</title>
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
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
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
    <h1>Produk Management</h1>

    <!-- Form for adding or updating a product -->
    <form action="produk_management.php" method="post">
        <?php if (isset($edit_produk_id)): ?>
            <input type="hidden" name="produk_id" value="<?php echo $edit_produk_id; ?>">
            <input type="hidden" name="submit" value="update">
        <?php else: ?>
            <input type="hidden" name="submit" value="add">
        <?php endif; ?>
        <label for="produk_id_kat">ID Kategori:</label><br>
        <input type="text" id="produk_id_kat" name="produk_id_kat" value="<?php if (isset($edit_produk_id_kat)) echo $edit_produk_id_kat; ?>"><br>
        <label for="produk_id_user">ID User:</label><br>
        <input type="text" id="produk_id_user" name="produk_id_user" value="<?php if (isset($edit_produk_id_user)) echo $edit_produk_id_user; ?>"><br>
        <label for="produk_kode">Kode Produk:</label><br>
        <input type="text" id="produk_kode" name="produk_kode" value="<?php if (isset($edit_produk_kode)) echo $edit_produk_kode; ?>"><br>
        <label for="produk_nama">Nama Produk:</label><br>
        <input type="text" id="produk_nama" name="produk_nama" value="<?php if (isset($edit_produk_nama)) echo $edit_produk_nama; ?>"><br>
        <label for="produk_hrg">Harga Produk:</label><br>
        <input type="text" id="produk_hrg" name="produk_hrg" value="<?php if (isset($edit_produk_hrg)) echo $edit_produk_hrg; ?>"><br>
        <label for="produk_keterangan">Keterangan Produk:</label><br>
        <textarea id="produk_keterangan" name="produk_keterangan"><?php if (isset($edit_produk_keterangan)) echo $edit_produk_keterangan; ?></textarea><br>
        <label for="produk_stock">Stok Produk:</label><br>
        <input type="text" id="produk_stock" name="produk_stock" value="<?php if (isset($edit_produk_stock)) echo $edit_produk_stock; ?>"><br>
        <label for="produk_photo">Foto Produk:</label><br>
        <input type="text" id="produk_photo" name="produk_photo" value="<?php if (isset($edit_produk_photo)) echo $edit_produk_photo; ?>"><br>
        <input type="submit" value="<?php if (isset($edit_produk_id)) echo 'Update'; else echo 'Add'; ?>">
    </form>

   
    <br>

<!-- List of products -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>ID Kategori</th>
        <th>ID User</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Harga Produk</th>
        <th>Keterangan Produk</th>
        <th>Stok Produk</th>
        <th>Foto Produk</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?php echo $product['produk_id']; ?></td>
        <td><?php echo $product['produk_id_kat']; ?></td>
        <td><?php echo $product['produk_id_user']; ?></td>
        <td><?php echo $product['produk_kode']; ?></td>
        <td><?php echo $product['produk_nama']; ?></td>
        <td><?php echo $product['produk_hrg']; ?></td>
        <td><?php echo $product['produk_keterangan']; ?></td>
        <td><?php echo $product['produk_stock']; ?></td>
        <td><?php echo $product['produk_photo']; ?></td>
        <td>
            <a href="produk_management.php?action=edit&id=<?php echo $product['produk_id']; ?>">Edit</a> |
            <a href="produk_management.php?action=delete&id=<?php echo $product['produk_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
