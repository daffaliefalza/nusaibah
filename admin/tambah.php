<?php include '../config.php'; ?>
<?php include 'auth.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "upload/" . $gambar);

    $conn->query("INSERT INTO produk (nama_produk, kategori_produk, gambar, harga, deskripsi, stok) 
    VALUES ('$nama', '$kategori', '$gambar', '$harga', '$deskripsi', '$stok')");
    header("Location: index.php");
}
?>
<h2>Tambah Produk</h2>
<form method="POST" enctype="multipart/form-data">
    Nama: <input name="nama"><br>
    Kategori: <input name="kategori"><br>
    Harga: <input name="harga"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Stok: <input name="stok"><br>
    Gambar: <input type="file" name="gambar"><br>
    <button type="submit">Simpan</button>
</form>