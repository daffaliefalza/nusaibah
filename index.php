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
        .cart {
            position: relative;
            display: inline-block;
        }

        .cart-icon {
            width: 30px;
            height: 30px;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
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
            width: 350px;
            height: auto;
            margin-bottom: 1rem;
        }

        .harga {
            font-weight: bold;
            color: rgb(38, 43, 37);
            margin: 10px 0;
        }

        .order {
            display: inline-block;
            background-color: #ab7b5d;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .order:hover {
            background-color: rgb(71, 42, 23);
        }

        /* Filter buttons styling */
        .filter-buttons {
            display: flex;
            gap: 12px;
            margin: 20px 0 30px;
            justify-content: center;
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
                <li><a href="about.php">About</a></li>
                <li><a href="kontak.php">Contact</a></li>
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

            <div class="product-wrapper">
                <?php
                // Modify the query based on the selected category
                $query = "SELECT * FROM produk";
                if ($category !== 'all') {
                    $query .= " WHERE kategori_produk = '" . $conn->real_escape_string($category) . "'";
                }

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="produk-card">
                        <img src="admin/upload/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                        <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
                        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <a href="#" class="order" onclick="addToCart(<?= $row['id_produk'] ?>, '<?= htmlspecialchars(addslashes($row['nama_produk'])) ?>', <?= $row['harga'] ?>)">
                            Masukkan Keranjang
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
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