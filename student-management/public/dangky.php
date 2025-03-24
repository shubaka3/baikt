<?php
session_start();
if (!isset($_SESSION['MaSV'])) {
    header("Location: index.php");
    exit();
}

require_once '../config/database.php';

$MaSV = $_SESSION['MaSV'];
$MaHP = $_GET['MaHP'];

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM HocPhan WHERE MaHP = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$MaHP]);
$hocphan = $stmt->fetch(PDO::FETCH_ASSOC);

if ($hocphan) {
    $_SESSION['cart'][$MaHP] = [
        'TenHP' => $hocphan['TenHP'],
        'SoTinChi' => $hocphan['SoTinChi']
    ];
}

header("Location: chitietdangky.php");
exit();
?>
