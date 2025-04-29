<?php
include 'config.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_produk = $_GET['id'];

// Fetch product details
$query = "SELECT * FROM produk WHERE id_produk = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$produk = $result->fetch_assoc();
$isOutOfStock = $produk['stok'] <= 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= htmlspecialchars($produk['nama_produk']) ?> | Detail Produk</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($produk['nama_produk']) ?> - <?= htmlspecialchars(substr($produk['deskripsi'], 0, 150)) ?>..." />

    <link rel="stylesheet" href="css/default.css" />
    <style>
        .product-detail-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2rem;
            color: #5a4a42;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #ab7b5d;
        }

        .back-button svg {
            width: 20px;
            height: 20px;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .product-image {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            height: 400px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .product-header {
            margin-bottom: 1.5rem;
        }

        .product-title {
            font-size: 1.8rem;
            color: #2a3a2f;
            margin-bottom: 0.5rem;
        }

        .product-category {
            display: inline-block;
            background-color: #f0e6dd;
            color: #5a4a42;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2a3a2f;
            margin: 1.5rem 0;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .in-stock {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .out-of-stock {
            background-color: #ffebee;
            color: #c62828;
        }

        .stock-status svg {
            width: 16px;
            height: 16px;
        }

        .product-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 0.85rem;
            color: #6b7b6f;
            margin-bottom: 4px;
        }

        .meta-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: #2a3a2f;
        }

        .product-description {
            margin-bottom: 2rem;
            line-height: 1.6;
            color: #5a6d5f;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: auto;
        }

        .add-to-cart {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ab7b5d;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            flex: 1;
        }

        .add-to-cart:hover {
            background-color: #8c634a;
        }

        .add-to-cart:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .add-to-cart svg {
            width: 18px;
            height: 18px;
        }

        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #25D366;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            text-decoration: none;
            flex: 1;
        }

        .whatsapp-button:hover {
            background-color: #128C7E;
        }

        .whatsapp-button svg {
            width: 18px;
            height: 18px;
        }

        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 1.5rem;
            }

            .product-image {
                height: 300px;
            }

            .product-meta {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .product-detail {
                padding: 1rem;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
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
                <li><a href="index.php">Produk</a></li>
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

    <div class="product-detail-container">
        <a href="index.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Produk
        </a>

        <div class="product-detail">
            <div class="product-image-container">
                <img src="admin/upload/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="product-image">
            </div>

            <div class="product-info">
                <div class="product-header">
                    <h1 class="product-title"><?= htmlspecialchars($produk['nama_produk']) ?></h1>
                    <span class="product-category"><?= htmlspecialchars($produk['kategori_produk']) ?></span>
                </div>

                <div class="stock-status <?= $isOutOfStock ? 'out-of-stock' : 'in-stock' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <?php if ($isOutOfStock): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <?php else: ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        <?php endif; ?>
                    </svg>
                    <?= $isOutOfStock ? 'Stok Habis' : 'Stok Tersedia' ?>
                </div>

                <p class="product-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Berat Bersih</span>
                        <span class="meta-value"><?= htmlspecialchars($produk['berat']) ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Nomor Produk</span>
                        <span class="meta-value"><?= htmlspecialchars($produk['pirt']) ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Kategori</span>
                        <span class="meta-value"><?= htmlspecialchars($produk['kategori_produk']) ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Stok</span>
                        <span class="meta-value"><?= $isOutOfStock ? 'Habis' : 'Tersedia' ?></span>
                    </div>
                </div>

                <div class="product-description">
                    <h3>Deskripsi Produk</h3>
                    <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
                </div>

                <!-- <div class="action-buttons">
                    <button class="add-to-cart" onclick="addToCart(<?= $produk['id_produk'] ?>, '<?= htmlspecialchars(addslashes($produk['nama_produk'])) ?>', <?= $produk['harga'] ?>)" <?= $isOutOfStock ? 'disabled' : '' ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Masukkan Keranjang
                    </button>
                    <a href="https://wa.me/6281213567170?text=Halo admin, saya tertarik dengan produk <?= urlencode($produk['nama_produk']) ?> (ID: <?= $produk['id_produk'] ?>)" class="whatsapp-button" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Pesan via WhatsApp
                    </a>
                </div> -->
            </div>
        </div>
    </div>

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

        function addToCart(productId, productName, price) {
            // Add item to cart (using your existing cart.js function)
            addToCart(productId, productName, price);

            // Update cart count
            updateCartCount();

            // Optional: Show some feedback to user
            alert(productName + ' telah ditambahkan ke keranjang!');
        }
    </script>
</body>

</html>