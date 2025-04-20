<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nusaibah | Bumbu & Rempah | Herbs & Spices</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Nusaibah adalah produsen bumbu dan rempah terbaik" />

    <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="css/home.css" />

    <style>
        .cart {
            position: relative;
            color: #333;
            font-weight: bold;
        }

        .produk-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .produk-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .produk-card img {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
        }

        .harga {
            font-weight: bold;
            color: #e74c3c;
            margin: 10px 0;
        }

        .order {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .order:hover {
            background-color: #2ecc71;
        }
    </style>
</head>

<body>

    <!-- nav start -->
    <nav style="border: 1px solid red;">
        <div class="container">
            <a href="#" class="logo">
                <img src="images/logo.jpg" alt="logo" style="width: 80px" />
            </a>
            <ul class="nav-links">
                <li><a href="index.html" class="active">Produk</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="kontak.html">Contact</a></li>
            </ul>
            <div class="cart">
                <a href="cart.html">
                    <img src="images/cart.png" alt="cart" />
                    <span id="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>
    <!-- nav end -->

    <!-- main section -->
    <main>
        <div class="container">
            <h1>Nusaibah Bumbu & Rempah</h1>
            <p>
                Temukan keotentikan rempah-rempah Nusantara bersama Nusaibah. Setiap
                bumbu kami dipilih dan diolah dengan cermat untuk menghadirkan cita
                rasa tradisional yang memperkaya setiap hidangan. Mulai dari rempah
                utuh yang mendalam hingga bubuk halus siap pakai, setiap produk kami
                menjamin kualitas dan kelezatan dalam setiap taburan.
            </p>

            <h2>Daftar Produk</h2>
            <div class="produk-list">
                <?php
                $result = $conn->query("SELECT * FROM produk");

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="produk-card">
                        <img src="admin/upload/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                        <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
                        <p>Kategori: <?= htmlspecialchars($row['kategori_produk']) ?></p>
                        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <p><?= htmlspecialchars($row['deskripsi']) ?></p>
                        <p>Stok: <?= htmlspecialchars($row['stok']) ?></p>
                        <a href="#" class="order" onclick="addToCart(<?= $row['id_produk'] ?>, '<?= htmlspecialchars(addslashes($row['nama_produk'])) ?>', <?= $row['harga'] ?>)">
                            Masukkan Keranjang
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <!-- main section end -->

    <!-- footer start -->
    <footer>
        &copy; 2024 - Afiat Barokah Mandri | All rights reserved. Designed By
        <a style="text-decoration: underline; color: #fff" href="https://webwirausahamuda.com" target="_blank">Wimuda</a>
    </footer>
    <!-- footer end -->

    <script src="js/cart.js"></script>
    <script>
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>

</html>