<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <link rel="stylesheet" href="../css/default.css" />

  <style>
    body {
      background-color: #f4f5f7;
      color: #333;
    }

    .wrapper {
      height: 100vh;
      display: grid;
      grid-template-columns: 1fr 2fr 2fr 2fr;
      grid-template-rows: auto 1fr 1fr auto;
      grid-template-areas:
        "aside top-bar top-bar top-bar"
        "aside content content content"
        "aside content content content"
        "aside footer footer footer";
    }

    aside {
      grid-area: aside;
      background-color: #2c3e50;
      color: #fff;
      padding: 20px;
    }

    aside ul {
      list-style-type: none;
    }

    aside li {
      margin: 20px 0;
    }

    aside a {
      color: #ecf0f1;
      text-decoration: none;
      font-weight: 600;
    }

    aside a:hover {
      color: #bdc3c7;
    }

    .top-bar {
      grid-area: top-bar;
      background-color: #2c3e50;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 10px 20px;
      font-size: 1.2em;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .content {
      grid-area: content;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .footer {
      grid-area: footer;
      background-color: #2c3e50;
      color: #fff;
      text-align: center;
      padding: 15px;
      font-size: 0.9em;
    }

    .top-bar,
    .content,
    .footer {
      margin: 1rem 1rem;
    }

    @media (max-width: 768px) {
      .wrapper {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto 1fr auto auto;
        grid-template-areas:
          "aside"
          "top-bar"
          "content"
          "content"
          "footer";
      }
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <aside>
      <ul>
        <li><a href="#">Kelola Produk</a></li>

        <li><a href="login.html">Logout</a></li>
      </ul>
    </aside>
    <div class="top-bar">Kelola Produk</div>
    <div class="content">
      <h2>Welcome to the Dashboard</h2>
      <p>Here’s where you can manage your products, view orders, and more.</p>
    </div>
    <div class="footer">
      &copy; 2024 Your Company Name. All Rights Reserved.
    </div>
  </div>
</body>

</html> -->

<?php include '../config.php'; ?>

<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>Kelola Produk</title>
</head>

<body>
  <h2>Daftar Produk</h2>
  <a href="tambah.php">Tambah Produk</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Gambar</th>
      <th>Harga</th>
      <th>Deskripsi</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM produk");
    while ($row = $result->fetch_assoc()):
    ?>
      <tr>
        <td><?= $row['id_produk'] ?></td>
        <td><?= $row['nama_produk'] ?></td>
        <td><?= $row['kategori_produk'] ?></td>
        <td><img src="upload/<?= $row['gambar'] ?>" width="60" /></td>
        <td><?= $row['harga'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td><?= $row['stok'] ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id_produk'] ?>">Edit</a> |
          <a href="hapus.php?id=<?= $row['id_produk'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>

</html>