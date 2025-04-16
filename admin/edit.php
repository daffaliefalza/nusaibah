<?php include '../config.php'; ?>
<?php include 'auth.php'; ?>

<?php
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM produk WHERE id_produk=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "upload/" . $gambar);
        $conn->query("UPDATE produk SET nama_produk='$nama', kategori_produk='$kategori', gambar='$gambar', harga='$harga', deskripsi='$deskripsi', stok='$stok' WHERE id_produk=$id");
    } else {
        $conn->query("UPDATE produk SET nama_produk='$nama', kategori_produk='$kategori', harga='$harga', deskripsi='$deskripsi', stok='$stok' WHERE id_produk=$id");
    }

    header("Location: index.php");
}
?>
<h2>Edit Produk</h2>
<form method="POST" enctype="multipart/form-data">
    Nama: <input name="nama" value="<?= $product['nama_produk'] ?>"><br>
    Kategori: <input name="kategori" value="<?= $product['kategori_produk'] ?>"><br>
    Harga: <input name="harga" value="<?= $product['harga'] ?>"><br>
    Deskripsi: <textarea name="deskripsi"><?= $product['deskripsi'] ?></textarea><br>
    Stok: <input name="stok" value="<?= $product['stok'] ?>"><br>
    Gambar Baru (jika ada): <input type="file" name="gambar"><br>
    <button type="submit">Update</button>
</form>