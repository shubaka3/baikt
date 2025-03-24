<?php
require_once '../models/SinhVien.php';

$sinhVienModel = new SinhVien();

if (isset($_GET['id'])) {
    $deleted = $sinhVienModel->delete($_GET['id']);
    
    if ($deleted) {
        header("Location: index.php?message=Xóa thành công");
    } else {
        echo "<div class='alert alert-danger'>Xóa thất bại!</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Không có ID sinh viên!</div>";
}
?>
