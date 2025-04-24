<?php include '../config.php'; ?>
<?php include 'auth.php'; ?>

<?php
if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%' OR kategori_produk LIKE '%$search%'";
} else {
  $sql = "SELECT * FROM produk";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Produk</title>
  <link rel="stylesheet" href="../css/default.css" />
  <link rel="stylesheet" href="../css/admin.css">
  <style>
    /* Main responsive table styles */
    .table-container {
      width: 100%;
      overflow-x: auto;
      position: relative;
      margin: 20px 0;
      -webkit-overflow-scrolling: touch;
    }

    /* Scroll indicator styles */
    .scroll-indicator {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 8px 5px;
      border-radius: 50%;
      display: none;
      z-index: 10;
      animation: bounce 2s infinite;
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateX(0) translateY(-50%);
      }

      40% {
        transform: translateX(-5px) translateY(-50%);
      }

      60% {
        transform: translateX(-3px) translateY(-50%);
      }
    }

    /* Table styles */
    .content {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
      /* Ensures table doesn't shrink too much */
    }

    .content thead th {
      /* background-color: #ab7b5d; */
      /* color: white; */
      padding: 12px;
      text-align: left;
      position: sticky;
      top: 0;
    }

    .content tbody td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle;
    }

    .content tbody tr:hover {
      background-color: #f5f5f5;
    }

    /* Action buttons */
    .action-links {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .action-links a {
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s;
    }

    .action-links a:first-child {
      background-color: #3498db;
      color: white;
    }

    .action-links a:last-child {
      background-color: #e74c3c;
      color: white;
    }

    .action-links a:hover {
      opacity: 0.8;
    }

    /* Product image */
    .content img {
      max-width: 100px;
      height: auto;
      border-radius: 4px;
    }

    /* Responsive adjustments */
    @media (max-width: 908px) {
      .main-content-header {
        flex-direction: column !important;
        gap: 15px;
      }

      .table-container {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      .scroll-indicator {
        display: block;
      }

      .content thead th,
      .content tbody td {
        padding: 8px 12px;
      }
    }

    @media (max-width: 480px) {
      .main-content-header form input {
        width: 100% !important;
      }
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <?php include 'sidebar.php' ?>
    <div class="top-bar">
      <h2>Kelola Produk</h2>
      <div class="top-bar-links">
        <h3>Halo, <span style="color: #9f9f9f">Admin</span></h3>
      </div>
    </div>
    <main class="main-content">
      <div class="main-content-header">
        <h3>Data Produk</h3>
        <a href="tambah.php" class="admin-produk" style="text-decoration: none;">+ Tambah Produk</a>
        <form action="" method="get" style="display: flex; width: 100%; max-width: 500px;">
          <input type="text" name="search" placeholder="Cari berdasarkan nama atau kategori" style="flex: 1; padding: 10px; border-radius: 5px 0 0 5px; border: 1px solid #ccc;">
          <button type="submit" style="padding: 10px 20px; background-color: #3498db; color: #fff; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">Search</button>
        </form>
      </div>

      <div class="table-container">
        <div class="scroll-indicator">→</div>
        <table class="content">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Gambar</th>
              <th>Harga</th>
              <th>Deskripsi</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo htmlspecialchars($row['nama_produk']) ?></td>
                <td><?php echo htmlspecialchars($row['kategori_produk']) ?></td>
                <td>
                  <img src="upload/<?php echo htmlspecialchars($row['gambar']) ?>" alt="<?php echo htmlspecialchars($row['nama_produk']) ?>" />
                </td>
                <td><?php echo 'Rp ' . number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?php echo htmlspecialchars(substr($row['deskripsi'], 0, 50)) . (strlen($row['deskripsi']) > 50 ? '...' : '') ?></td>
                <td><?php echo $row['stok'] ?></td>
                <td>
                  <div class="action-links">
                    <a href="ubah.php?id_produk=<?php echo $row['id_produk'] ?>">Ubah</a>
                    <a href="hapus.php?id_produk=<?php echo $row['id_produk'] ?>" onclick="return confirm('Apakah kamu ingin menghapus data?')">Hapus</a>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
    <footer class="admin-footer" style="color: #fff !important;">
      &copy; Nusaibah 2025 - All Rights Reserved
    </footer>
  </div>

  <script>
    // Add scroll event listener to hide indicator when scrolled
    document.addEventListener('DOMContentLoaded', function() {
      const tableContainer = document.querySelector('.table-container');
      const scrollIndicator = document.querySelector('.scroll-indicator');

      if (tableContainer && scrollIndicator) {
        tableContainer.addEventListener('scroll', function() {
          // Hide indicator if user has scrolled right
          if (this.scrollLeft > 20) {
            scrollIndicator.style.opacity = '0';
          } else {
            scrollIndicator.style.opacity = '1';
          }
        });

        // Check if scrolling is needed on load
        if (tableContainer.scrollWidth <= tableContainer.clientWidth) {
          scrollIndicator.style.display = 'none';
        }
      }
    });
  </script>
</body>

</html>


<!-- <?php include '../config.php'; ?>
<?php include 'auth.php'; ?>


<?php



if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%' OR kategori_produk LIKE '%$search%'";
} else {
  $sql = "SELECT * FROM produk";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin - Produk</title>
  <link rel="stylesheet" href="../css/default.css" />
  <link rel="stylesheet" href="../css/admin.css">

  <style>
    @media (max-width: 908px) {
      .main-content-header {
        flex-direction: column !important;
      }
    }
  </style>

</head>

<body>
  <div class="wrapper">
    <?php include 'sidebar.php' ?>
    <div class="top-bar">
      <h2>Kelola Produk</h2>
      <div class="top-bar-links">
        <h3>Halo, <span style="color: #9f9f9f">Admin</span></h3>
      </div>
    </div>
    <main class="main-content">
      <div class="main-content-header">
        <h3>Data Produk</h3>
        <a href="tambah.php" class="admin-produk" style="text-decoration: none;">+ Tambah Produk</a>
        <form action="" method="get" style="display: flex;">
          <input type="text" name="search" placeholder="Cari berdasarkan nama atau kategori" style="  width: 300px; padding: 10px; border-radius: 5px 0 0 5px; border: 1px solid #ccc;">
          <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 0 5px 5px 0; cursor: pointer;">Search</button>
        </form>
      </div>

      <table class="content">
        <thead>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Kategori Produk</th>
          <th>Gambar</th>
          <th>Harga</th>
          <th>Deskripsi</th>
          <th>Stok</th>
          <th>Aksi</th>
        </thead>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tbody>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['nama_produk'] ?> </td>
            <td><?php echo $row['kategori_produk'] ?></td>
            <td>
              <img style="width: 250px;" src="upload/<?php echo $row['gambar']; ?>" />
            </td>
            <td><?php echo 'Rp ' . number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?php echo $row['deskripsi'] ?></td>
            <td><?php echo $row['stok'] ?></td>
            <td style="display: flex; align-items: center; height: 200px">
              <a href="ubah.php?id_produk=<?php echo $row['id_produk'] ?>" disabled>Ubah</a>
              <a onclick="return confirm('Apakah kamu ingin menghapus data?')" href="hapus.php?id_produk=<?php echo $row['id_produk'] ?>" style="color: rgb(158, 20, 20)">Hapus</a>
            </td>
          </tbody>
        <?php } ?>
      </table>
    </main>
    <footer class="admin-footer" style="color: #fff !important;">
      &copy; Nusaibah 2025 - All Rights Reserved
    </footer>
  </div>
</body>

</html> -->