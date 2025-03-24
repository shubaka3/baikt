<?php
session_start();
if (!isset($_SESSION['MaSV'])) {
    header("Location: index.php");
    exit();
}

require_once '../config/database.php';

$database = new Database();
$conn = $database->getConnection();
$MaSV = $_SESSION['MaSV'];

// Lấy danh sách học phần
$query = "SELECT * FROM HocPhan";
$stmt = $conn->prepare($query);
$stmt->execute();
$hocphans = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh sách học phần đã đăng ký
$query = "SELECT MaHP FROM ChiTietDangKy 
          JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
          WHERE DangKy.MaSV = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$MaSV]);
$daDangKy = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<?php include '../templates/header.php'; ?>
<div class="container">
    <h2>Danh sách học phần</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Mã học phần</th>
                <th>Tên học phần</th>
                <th>Số tín chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hocphans as $hp): ?>
            <tr>
                <td><?= htmlspecialchars($hp['MaHP']) ?></td>
                <td><?= htmlspecialchars($hp['TenHP']) ?></td>
                <td><?= htmlspecialchars($hp['SoTinChi']) ?></td>
                <td>
                    <?php if (!in_array($hp['MaHP'], $daDangKy)): ?>
                        <a href="dangky.php?MaHP=<?= htmlspecialchars($hp['MaHP']) ?>" class="btn btn-success">Đăng ký</a>
                    <?php else: ?>
                        <span class="text-muted">Đã đăng ký</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../templates/footer.php'; ?>
