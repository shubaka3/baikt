<?php
require_once __DIR__ . '/../controllers/SinhVienController.php';
$controller = new SinhVienController();
$sinhViens = $controller->index();
?>

<?php include '../templates/header.php'; ?>
<h2>Danh sách Sinh Viên</h2>
<a href="create.php">Thêm Sinh Viên</a>
<table border="1">
    <tr>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Giới Tính</th>
        <th>Ngày Sinh</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($sinhViens as $sv): ?>
        <tr>
            <td><?= $sv['MaSV'] ?></td>
            <td><?= $sv['HoTen'] ?></td>
            <td><?= $sv['GioiTinh'] ?></td>
            <td><?= $sv['NgaySinh'] ?></td>
            <td>
                <a href="detail.php?id=<?= $sv['MaSV'] ?>">Xem</a> | 
                <a href="edit.php?id=<?= $sv['MaSV'] ?>">Sửa</a> | 
                <a href="delete.php?id=<?= $sv['MaSV'] ?>">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include '../templates/footer.php'; ?>
