<?php
include 'config.php';

// File upload directory (make sure this matches your admin path)
$upload_dir = 'admin/uploads/gallery/';

// Get all gallery images
$images = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Galeri Dokumentasi | Nusaibah </title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Galeri dokumentasi produk Nusaibah - Bumbu & Rempah Berkualitas" />
    <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="icon" type="image/x-icon" href="/images/logo.jpg">
    <style>
        /* Main Gallery Styles */
        .gallery-section {
            padding: 4rem 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: #e67e22;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            aspect-ratio: 1/1;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            grid-column: 1 / -1;
            padding: 3rem 0;
        }

        .empty-icon {
            font-size: 3rem;
            color: #bdc3c7;
            margin-bottom: 1rem;
        }

        .empty-text {
            color: #7f8c8d;
            font-size: 1.2rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .gallery-section {
                padding: 2rem 0;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .section-header {
                margin-bottom: 2rem;
            }
        }

        /* Lightbox Effect */
        .gallery-item {
            cursor: pointer;
        }

        /* Footer Adjustments */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 0;
        }

        footer a {
            color: #e67e22;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #d35400;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="images/logo.jpg" alt="logo" style="width: 80px" />
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Produk</a></li>
                <li><a href="about.php">Tentang Kami</a></li>
                <li><a href="galeri.php" class="active">Galeri</a></li>
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

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Galeri Dokumentasi</h2>
                <p class="section-subtitle">Kumpulan momen dan dokumentasi produk Nusaibah. </p>
            </div>

            <div class="gallery-grid">
                <?php if ($images->num_rows > 0): ?>
                    <?php while ($image = $images->fetch_assoc()): ?>
                        <div class="gallery-item">
                            <img src="<?php echo $upload_dir . $image['image_path']; ?>" alt="Dokumentasi Nusaibah" class="gallery-img">
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">📷</div>
                        <p class="empty-text">Belum ada dokumentasi yang tersedia</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; 2024 - Afiat Barokah Mandri | All rights reserved. Designed By
            <a href="https://webwirausahamuda.com" style="text-decoration: underline !important; color: #fff; " target="_blank">Wimuda</a>
        </div>
    </footer>

    <!-- WhatsApp Float -->
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

        // Simple lightbox functionality
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src;
                const lightbox = document.createElement('div');
                lightbox.style.position = 'fixed';
                lightbox.style.top = '0';
                lightbox.style.left = '0';
                lightbox.style.width = '100%';
                lightbox.style.height = '100%';
                lightbox.style.backgroundColor = 'rgba(0,0,0,0.9)';
                lightbox.style.display = 'flex';
                lightbox.style.alignItems = 'center';
                lightbox.style.justifyContent = 'center';
                lightbox.style.zIndex = '1000';
                lightbox.style.cursor = 'zoom-out';

                const img = document.createElement('img');
                img.src = imgSrc;
                img.style.maxWidth = '90%';
                img.style.maxHeight = '90%';
                img.style.objectFit = 'contain';

                lightbox.appendChild(img);
                document.body.appendChild(lightbox);

                lightbox.addEventListener('click', () => {
                    document.body.removeChild(lightbox);
                });
            });
        });
    </script>
</body>

</html>