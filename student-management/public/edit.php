<?php
require_once '../models/SinhVien.php';
include '../templates/header.php';

$sinhVienModel = new SinhVien();

// Kiểm tra nếu có ID
if (isset($_GET['id'])) {
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

// Xử lý khi nhấn nút cập nhật
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];

    $updated = $sinhVienModel->update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    
    if ($updated) {
        echo "<div class='alert alert-success'>Cập nhật thành công!</div>";
        $student = $sinhVienModel->getById($MaSV); // Lấy lại dữ liệu mới cập nhật
    } else {
        echo "<div class='alert alert-danger'>Cập nhật thất bại!</div>";
    }
}
?>

<h2>Chỉnh sửa Sinh Viên</h2>
<form method="POST">
    <input type="hidden" name="MaSV" value="<?= htmlspecialchars($student['MaSV']) ?>">
    
    <div class="mb-3">
        <label for="HoTen" class="form-label">Họ tên:</label>
        <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?= htmlspecialchars($student['HoTen']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="GioiTinh" class="form-label">Giới tính:</label>
        <select class="form-control" id="GioiTinh" name="GioiTinh">
            <option value="Nam" <?= $student['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= $student['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="NgaySinh" class="form-label">Ngày sinh:</label>
        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?= htmlspecialchars($student['NgaySinh']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="Hinh" class="form-label">Hình ảnh:</label>
        <input type="text" class="form-control" id="Hinh" name="Hinh" value="<?= htmlspecialchars($student['Hinh']) ?>">
    </div>

    <div class="mb-3">
        <label for="MaNganh" class="form-label">Mã ngành:</label>
        <input type="text" class="form-control" id="MaNganh" name="MaNganh" value="<?= htmlspecialchars($student['MaNganh']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="index.php" class="btn btn-secondary">Quay lại</a>
</form>

<?php include '../templates/footer.php'; ?>
