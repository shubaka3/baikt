<?php
require_once '../models/SinhVien.php';
include '../templates/header.php';

if (isset($_GET['id'])) {
    $sinhVienModel = new SinhVien();
    $student = $sinhVienModel->getById($_GET['id']);

    if (!$student) {
        echo "<div class='alert alert-danger'>Không tìm thấy sinh viên!</div>";
        include '../templates/footer.php';
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>Không có ID sinh viên!</div>";
    include '../templates/footer.php';
    exit();
}
?>

<h2>Chi tiết Sinh Viên</h2>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($student['HoTen']) ?></h5>
        <p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
        <p><strong>Giới tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
        <p><strong>Ngày sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
        <p><strong>Mã Ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
        <a href="edit.php?id=<?= htmlspecialchars($student['MaSV']) ?>" class="btn btn-warning">Chỉnh sửa</a>
        <a href="delete.php?id=<?= htmlspecialchars($student['MaSV']) ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
