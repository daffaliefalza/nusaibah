<?php
session_start();
include '../config.php'; // koneksi DB

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Password tidak sama.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed);

        if ($stmt->execute()) {
            $success = "Admin berhasil didaftarkan.";
            echo "<script>alert('Berhasil daftar, silahkan login menggunakan akun yang telah didaftar.');</script>";
        } else {
            $error = "Username sudah digunakan.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #a8edea);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .register-container input {
            width: 100%;
            padding: 12px 16px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .register-container input:focus {
            border-color: #f6a76e;
            outline: none;
        }

        .register-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #7a9cc6;

            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .register-container button:hover {
            background-color: #e98a4d;
        }

        .register-container p {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-container p a {
            color: #e98a4d;
            text-decoration: none;
        }

        .register-container p a:hover {
            text-decoration: underline;
        }

        .register-container .error {
            color: red;
            margin-bottom: 10px;
        }

        .register-container .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <div class="register-container">
        <h2>Register Admin</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <button type="submit">Register</button>
        </form>

        <p><a href="login.php">Sudah punya akun? Login</a></p>
    </div>
</body>

</html>