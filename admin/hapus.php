<?php
require('../config.php');

if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // First, get the image filename from the database
    $query = "SELECT gambar FROM produk WHERE id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_file = $row['gambar'];

        // Delete the product from database
        $sql = "DELETE FROM produk WHERE id_produk = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_produk);
        $result = $stmt->execute();

        if ($result) {
            // Delete the image file if it exists
            $upload_directory = "upload/";
            $image_path = $upload_directory . $image_file;

            if (file_exists($image_path) && is_file($image_path)) {
                unlink($image_path);
            }

            echo '<script>alert("Data produk berhasil dihapus."); window.location = "index.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data!");</script>';
        }
    } else {
        echo '<script>alert("Produk tidak ditemukan!"); window.location = "index.php";</script>';
    }
}
