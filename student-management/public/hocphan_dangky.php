<?php
session_start();
if (!isset($_SESSION['MaSV'])) {
    header("Location: index.php");
    exit();
}

require_once '../config/database.php';

$MaSV = $_SESSION['MaSV'];
$HoTen = $_SESSION['HoTen'];

$database = new Database();
$conn = $database->getConnection();

// Lấy danh sách học phần đã lưu từ database
$query = "
    SELECT HP.MaHP, HP.TenHP, HP.SoTinChi, DK.NgayDK
    FROM ChiTietDangKy CT
    JOIN DangKy DK ON CT.MaDK = DK.MaDK
    JOIN HocPhan HP ON CT.MaHP = HP.MaHP
    WHERE DK.MaSV = ?
    ORDER BY DK.NgayDK DESC";
$stmt = $conn->prepare($query);
$stmt->execute([$MaSV]);
$hocphans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../templates/header.php'; ?>

<div class="container">
    <h2>Học phần đã đăng ký</h2>

    <?php if (empty($hocphans)): ?>
        <p class="text-danger">Bạn chưa đăng ký học phần nào.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Ngày Đăng Ký</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hocphans as $hp): ?>
                <tr>
                    <td><?= $hp['MaHP'] ?></td>
                    <td><?= $hp['TenHP'] ?></td>
                    <td><?= $hp['SoTinChi'] ?></td>
                    <td><?= date('d/m/Y', strtotime($hp['NgayDK'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <a href="chitietdangky.php" class="btn btn-primary">Quay lại Đăng Ký</a>
</div>

<?php include '../templates/footer.php'; ?>
