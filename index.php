<?php
include 'config.php';

// Get the selected category from the URL parameter
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
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
        .produk-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .produk-card {
            border: 1px solid #e8e8e8;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .produk-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .produk-card img {
            width: 100%;
            /* height: 250px; */
            object-fit: cover;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .harga {
            font-weight: bold;
            color: rgb(38, 43, 37);
            margin: 10px 0;
            font-size: 1.1rem;
        }

        .order {
            display: inline-block;
            background-color: #ab7b5d;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-weight: 500;
            width: 100%;
            max-width: 200px;
        }

        .order:hover {
            background-color: rgb(71, 42, 23);
            transform: translateY(-2px);
        }

        .order:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }

        /* Stock status */
        .stock-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .in-stock {
            background-color: #2ecc71;
            color: white;
        }

        .out-of-stock {
            background-color: #e74c3c;
            color: white;
        }

        /* Out of stock card styling */
        .produk-card.out-of-stock-card {
            opacity: 0.9;
            background-color: rgb(221, 221, 221);
        }

        .produk-card.out-of-stock-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(233, 233, 233, 0.7);
            z-index: 1;
        }

        /* Filter buttons styling */
        .filter-buttons {
            display: flex;
            gap: 12px;
            margin: 20px 0 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 24px;
            background-color: #f8f5f2;
            color: #5a4a42;
            border: 1px solid #d7ccc8;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .filter-btn:hover {
            background-color: #e8dfd9;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-btn.active {
            background-color: #ab7b5d;
            color: white;
            border-color: #ab7b5d;
            box-shadow: 0 4px 8px rgba(171, 123, 93, 0.2);
        }

        .filter-btn.active:hover {
            background-color: #8c634a;
            transform: translateY(-1px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .produk-list {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .filter-buttons {
                gap: 8px;
            }

            .filter-btn {
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .produk-list {
                grid-template-columns: 1fr;
            }

            .produk-card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- nav start -->
    <nav>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="images/logo.jpg" alt="logo" style="width: 80px" />
            </a>
            <ul class="nav-links">
                <li><a href="#" class="active">Produk</a></li>
                <li><a href="about.php">Tentang Kami</a></li>
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="kontak.php">Kontak</a></li>
            </ul>
            <div class="cart">
                <a href="cart.php">
                    <img src="images/cart.png" alt="cart" class="cart-icon" />
                    <span class="cart-count" id="cart-count">0</span>
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

            <!-- Filter buttons -->
            <div class="filter-buttons">
                <a href="?category=all" class="filter-btn <?= $category === 'all' ? 'active' : '' ?>">All Products</a>
                <a href="?category=bumbu" class="filter-btn <?= $category === 'bumbu' ? 'active' : '' ?>">Bumbu</a>
                <a href="?category=rempah" class="filter-btn <?= $category === 'rempah' ? 'active' : '' ?>">Rempah</a>
            </div>

            <div class="produk-list">
                <?php
                // Modify the query based on the selected category
                $query = "SELECT * FROM produk";
                if ($category !== 'all') {
                    $query .= " WHERE kategori_produk = '" . $conn->real_escape_string($category) . "'";
                }

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    $isOutOfStock = $row['stok'] <= 0;
                ?>
                    <div class="produk-card <?= $isOutOfStock ? 'out-of-stock-card' : '' ?>">
                        <div class="stock-status <?= $isOutOfStock ? 'out-of-stock' : 'in-stock' ?>">
                            <?= $isOutOfStock ? 'Stok Habis' : 'Tersedia' ?>
                        </div>
                        <img src="admin/upload/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                        <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
                        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <?php if ($isOutOfStock): ?>
                            <button class="order" disabled>Stok Habis</button>
                        <?php else: ?>
                            <button class="order" onclick="addToCart(<?= $row['id_produk'] ?>, '<?= htmlspecialchars(addslashes($row['nama_produk'])) ?>', <?= $row['harga'] ?>)">
                                Masukkan Keranjang
                            </button>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <!-- footer start -->
    <footer>
        &copy; 2024 - Afiat Barokah Mandiri | All rights reserved. Designed By
        <a style="text-decoration: underline; color: #fff" href="https://webwirausahamuda.com" target="_blank">Wimuda</a>
    </footer>
    <!-- footer end -->

    <a href="https://wa.me/6281213567170?text=Halo admin, %20saya%20ingin%20bertanya" target="_blank">
        <img class="whatsapp-redirect" src="images/whatsapp.svg" alt="WhatsApp icon" style="
          width: 65px;
          position: fixed;
          bottom: 2rem;
          right: 2rem;
          cursor: pointer;
          z-index: 50;
        " />
    </a>

    <script src="js/cart.js"></script>
    <script>
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>

</html>