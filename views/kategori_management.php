<?php

// Include the Kategori class
require_once('../classes/Kategori.php');

// Initialize Kategori object
$kategori = new Kategori();

// Check if form is submitted for adding or updating a category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit']) && $_POST['submit'] == 'add') {
        // Add new category
        $kat_nama = $_POST['kat_nama'];
        $kat_keterangan = $_POST['kat_keterangan'];
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $kategori->insertKategori($kat_nama, $kat_keterangan, $created_at, $updated_at);
    } elseif (isset($_POST['submit']) && $_POST['submit'] == 'update') {
        // Update category
        $kat_id = $_POST['kat_id'];
        $kat_nama = $_POST['kat_nama'];
        $kat_keterangan = $_POST['kat_keterangan'];
        $updated_at = date('Y-m-d H:i:s');
        $kategori->updateKategori($kat_id, $kat_nama, $kat_keterangan, $updated_at);
    }
}

// Check if delete button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $kat_id = $_GET['id'];
    $kategori->deleteKategori($kat_id);
}

// Fetch all categories
$categories = $kategori->getAllKategori();

// Check if edit button is clicked
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_kat_id = $_GET['id'];
    $edit_kat = $kategori->getKategoriById($edit_kat_id);
    if ($edit_kat) {
        $edit_kat_nama = $edit_kat['kat_nama'];
        $edit_kat_keterangan = $edit_kat['kat_keterangan'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

        .action-links a {
            margin-right: 5px;
            text-decoration: none;
            color: #333;
            padding: 2px 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .action-links a:hover {
            background-color: #f0f0f0;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Kategori Management</h1>

    <!-- Form for adding or updating a category -->
    <form action="kategori_management.php" method="post">
        <input type="hidden" name="kat_id" value="<?php if (isset($edit_kat_id)) echo $edit_kat_id; ?>">
        <label for="kat_nama">Nama Kategori:</label>
        <input type="text" id="kat_nama" name="kat_nama" value="<?php if (isset($edit_kat_nama)) echo $edit_kat_nama; ?>">
        <label for="kat_keterangan">Keterangan:</label>
        <textarea id="kat_keterangan" name="kat_keterangan"><?php if (isset($edit_kat_keterangan)) echo $edit_kat_keterangan; ?></textarea>
        <input type="submit" name="submit" value="<?php if (isset($edit_kat_id)) echo 'update'; else echo 'add'; ?>">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($categories)): ?>
        <p class="error">No categories found.</p>
    <?php endif; ?>

    <!-- List of categories -->
    <?php if (!empty($categories)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category['kat_id']; ?></td>
                <td><?php echo $category['kat_nama']; ?></td>
                <td><?php echo $category['kat_keterangan']; ?></td>
                <td class="action-links">
                    <a href="kategori_management.php?action=edit&id=<?php echo $category['kat_id']; ?>">Edit</a>
                    <a href="kategori_management.php?action=delete&id=<?php echo $category['kat_id']; ?>" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
