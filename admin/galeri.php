<?php
session_start();
include "../config.php";

// Get messages from session if they exist
$message = $_SESSION['message'] ?? null;
$error = $_SESSION['error'] ?? null;

// Clear messages after displaying
unset($_SESSION['message']);
unset($_SESSION['error']);

// File upload directory
$upload_dir = 'uploads/gallery/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new image
    if (isset($_POST['add_image'])) {
        if (!empty($_FILES['image']['name'])) {
            $file_name = basename($_FILES['image']['name']);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
            $max_size = 700 * 1024; // 700KB in bytes

            if (in_array($file_ext, $allowed_ext)) {
                if ($_FILES['image']['size'] <= $max_size) {
                    // Generate unique filename
                    $new_file_name = uniqid('img_', true) . '.' . $file_ext;
                    $target_path = $upload_dir . $new_file_name;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                        $stmt = $conn->prepare("INSERT INTO gallery (image_path) VALUES (?)");
                        $stmt->bind_param("s", $new_file_name);
                        $stmt->execute();

                        // Store success message in session and redirect
                        $_SESSION['message'] = "Gambar berhasil diupload dan akan muncul di sisi galeri customer!";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    } else {
                        $error = "Gagal mengupload gambar.";
                    }
                } else {
                    $error = "Ukuran file size melewati limit - 700kb";
                }
            } else {
                $error = "Hanya JPG, JPEG, PNG, dan Web file yang diperbolehkan. ";
            }
        } else {
            $error = "Please select an image file.";
        }
    }

    // Delete image
    if (isset($_POST['delete_image'])) {
        $id = $_POST['id'];

        // Get image path first
        $stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $image = $result->fetch_assoc();

        if ($image) {
            // Delete from database
            $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            // Delete file
            $file_path = $upload_dir . $image['image_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $_SESSION['message'] = "Gambar berhasil dihapus!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// Get all gallery images
$images = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/default.css">
    <style>
        /* Main Content Styling */
        .content-wrapper {
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 20px;
        }

        .section-title {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eaeaea;
        }

        /* Upload Form Styling */
        .upload-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-btn {
            display: inline-block;
            padding: 8px 12px;
            background: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 4px;
            color: #495057;
            width: 100%;
            text-align: center;
        }

        .file-input-btn:hover {
            background: #e9ecef;
        }

        .file-info {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        /* Gallery Grid Styling */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .gallery-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .gallery-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .gallery-actions {
            padding: 0.75rem;
            display: flex;
            justify-content: flex-end;
            background: #f8f9fa;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        /* Alert Styling */
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
            font-size: 0.9375rem;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include 'sidebar.php' ?>

        <div class="top-bar">
            <h2>Kelola Galeri</h2>
            <div class="top-bar-links">
                <h3>Halo, <span style="color: #9f9f9f">Admin</span></h3>
            </div>
        </div>

        <div class="content-wrapper main-content">
            <?php if (isset($message)): ?>
                <div class="alert success"><?php echo $message; ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>

            <h2 class="section-title">Tambahkan Gambar Baru</h2>
            <div class="upload-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Pilih Gambar</label>
                        <div class="file-input-wrapper">
                            <button type="button" class="file-input-btn">Choose File</button>
                            <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/webp" required>
                        </div>
                        <div class="file-info">
                            Format yang didukung: JPG, JPEG, PNG, WebP<br>
                            Ukuran maksimal: 700KB
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add_image" class="submit-btn">Upload Gambar</button>
                    </div>
                </form>
            </div>

            <h2 class="section-title">Daftar Gambar</h2>
            <div class="gallery-grid">
                <?php if ($images->num_rows > 0): ?>
                    <?php while ($image = $images->fetch_assoc()): ?>
                        <div class="gallery-item">
                            <img src="<?php echo $upload_dir . $image['image_path']; ?>" alt="Gallery Image" class="gallery-img">
                            <div class="gallery-actions">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $image['id']; ?>">
                                    <button type="submit" name="delete_image" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <p>Tidak ada gambar di galeri saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Update file input display
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose File';
            document.querySelector('.file-input-btn').textContent = fileName;
        });
    </script>
</body>

</html>