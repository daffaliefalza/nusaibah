<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'nusaibah';

$conn = new mysqli($host, $user, $pass, $db, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
