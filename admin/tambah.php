<?php include '../config.php'; ?>
<?php include 'auth.php'; ?>


<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $gambar = $_FILES['gambar']['name']; // Updated to handle file upload
    $image_tmp = $_FILES['gambar']['tmp_name']; // Temporary location of the file
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $upload_directory = "upload/"; // Define the upload directory

    move_uploaded_file($image_tmp, $upload_directory . $gambar); // Move the uploaded file to the defined directory

    $sql = "INSERT INTO produk VALUES ('', '$nama_produk', '$kategori_produk', '$gambar', $harga, '$deskripsi', $stok)";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Data produk berhasil ditambah."); window.location = "index.php";</script>';
    } else {
        echo '<script>alert("Gagal menambahkan data!");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/form-admin.css">

    <style>
        /* Style for input file */
        input[type="file"] {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .file-input-wrapper {
            position: relative;
            width: 100%;
        }

        .file-input-wrapper label {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for select */
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .back {
            font-size: 2.4rem;
        }
    </style>

</head>

<body>

    <a href="./index.php" class="back">
        ⇐ Kembali</a>

    <h1 style="text-align: center;">Tambah Data Produk</h1>

    <form action="" method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" is required for file uploads -->
        <label for="nama_produk">Nama Produk</label>
        <br>
        <input type="text" name="nama_produk" id="nama_produk" required>
        <br>

        <label for="kategori_produk">Kategori Produk</label>
        <br>
        <select name="kategori_produk" id="kategori_produk" required>
            <option value="Jamu">Jamu</option>
            <option value="Instan">Instan</option>
        </select>
        <br>

        <label for="gambar">Gambar</label>
        <br>

        <input type="file" name="gambar" id="gambar" required> <!-- Change input type to file for image upload -->
        <br>

        <label for="harga">Harga</label>
        <br>
        <input type="number" name="harga" id="harga" required>
        <br>

        <label for="deskripsi">Deskripsi</label>
        <br>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea>
        <br>

        <label for="stok">Stok</label>
        <br>
        <input type="number" name="stok" id="stok" required>
        <br>

        <button type="submit" name="tambah_data">Tambah!</button>

    </form>

</body>

</html>