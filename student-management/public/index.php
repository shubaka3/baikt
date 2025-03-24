<?php
session_start();
require_once '../models/SinhVien.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];

    $sinhVien = new SinhVien();
    $user = $sinhVien->login($MaSV);

    if ($user) {
        $_SESSION['MaSV'] = $user['MaSV'];
        $_SESSION['HoTen'] = $user['HoTen'];
        header("Location: hocphan.php");
        exit();
    } else {
        $error = "Mã sinh viên không tồn tại!";
    }
}
?>

<?php include '../templates/header.php'; ?>
<div class="container">
    <h2>Đăng nhập</h2>
    <form method="POST">
        <label for="MaSV">Mã số sinh viên:</label>
        <input type="text" name="MaSV" required class="form-control">
        <button type="submit" class="btn btn-primary mt-2">Đăng nhập</button>
    </form>
    <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>
<?php include '../templates/footer.php'; ?>
