<?php
require_once __DIR__ . '/../controllers/SinhVienController.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SinhVienController();
    $controller->create($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $_POST['Hinh'], $_POST['MaNganh']);
    header("Location: index.php");
}
?>

<?php include '../templates/header.php'; ?>
<h2>Thêm Sinh Viên</h2>
<form method="POST">
    <label>Mã SV:</label>
    <input type="text" name="MaSV" required><br>
    <label>Họ Tên:</label>
    <input type="text" name="HoTen" required><br>
    <label>Giới Tính:</label>
    <input type="text" name="GioiTinh" required><br>
    <label>Ngày Sinh:</label>
    <input type="date" name="NgaySinh" required><br>
    <label>Hình:</label>
    <input type="text" name="Hinh"><br>
    <label>Mã Ngành:</label>
    <input type="text" name="MaNganh" required><br>
    <button type="submit">Thêm</button>
</form>
<?php include '../templates/footer.php'; ?>
