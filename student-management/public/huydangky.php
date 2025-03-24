<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['MaHP'])) {
    $maHP = $_GET['MaHP'];
    $maSV = $_SESSION['MaSV'];

    // Xóa đăng ký
    $delete_sql = "DELETE FROM chitietdangky WHERE MaSV='$maSV' AND MaHP='$maHP'";
    mysqli_query($conn, $delete_sql);

    // Tăng số lượng còn lại
    $update_sql = "UPDATE hocphan SET so_luong_con_lai = so_luong_con_lai + 1 WHERE MaHP='$maHP'";
    mysqli_query($conn, $update_sql);

    $_SESSION['message'] = "Hủy đăng ký thành công!";
}

header("Location: hocphan_dadangky.php");
exit();
?>
