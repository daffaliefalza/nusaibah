<?php include '../config.php'; ?>
<?php include 'auth.php'; ?>

<?php
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Retrieve existing data based on id_produk
    $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if form is submitted for updating data
        if (isset($_POST['ubah_data'])) {
            $nama_produk = $_POST['nama_produk'];
            $kategori_produk = $_POST['kategori_produk'];
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $harga = $_POST['harga'];
            $deskripsi = $_POST['deskripsi'];
            $stok = $_POST['stok'];

            // Get the last image filename
            $last_gambar = $row['gambar'];

            // Define the upload directory
            $upload_directory = "upload/";

            // Move the uploaded file if a new image is uploaded
            if (!empty($gambar)) {
                move_uploaded_file($gambar_tmp, $upload_directory . $gambar);
            } else {
                $gambar = $last_gambar;
            }

            // Update the data
            $sql = "UPDATE produk SET 
                        nama_produk='$nama_produk', 
                        kategori_produk='$kategori_produk', 
                        gambar='$gambar', 
                        harga=$harga, 
                        deskripsi='$deskripsi', 
                        stok=$stok 
                    WHERE id_produk='$id_produk'";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<script>alert("Data produk berhasil diubah."); window.location = "index.php";</script>';
            } else {
                echo '<script>alert("Gagal mengubah data!");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Produk</title>

    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/form-admin.css">

    <style>
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

    <h1 style="text-align: center;">Ubah Data Produk</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama_produk">Nama Produk</label><br>
        <input type="text" name="nama_produk" id="nama_produk" value="<?php echo $row['nama_produk']; ?>"><br>

        <label for="kategori_produk">Kategori Produk</label><br>
        <select name="kategori_produk" id="kategori_produk">
            <option value="Jamu" <?php if ($row['kategori_produk'] == 'Jamu') echo 'selected'; ?>>Jamu</option>
            <option value="Instan" <?php if ($row['kategori_produk'] == 'Instan') echo 'selected'; ?>>Instan</option>
        </select><br>

        <label for="gambar">Gambar</label><br>
        <div class="file-input-wrapper" style="margin-top: 15px;">
            <input type="file" name="gambar" id="gambar">
            <label for="gambar" class="file-label">Pilih File</label>
        </div>
        <br>

        <label for="harga">Harga</label><br>
        <input type="number" name="harga" id="harga" value="<?php echo $row['harga']; ?>"><br>

        <label for="deskripsi">Deskripsi</label><br>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?php echo $row['deskripsi']; ?></textarea><br>

        <label for="stok">Stok</label><br>
        <input type="number" name="stok" id="stok" value="<?php echo $row['stok']; ?>"><br>

        <button type="submit" name="ubah_data">Ubah!</button>
    </form>

</body>

</html>