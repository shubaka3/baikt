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

// Xử lý khi nhấn "Xóa" học phần khỏi session
if (isset($_GET['remove'])) {
    $MaHP = $_GET['remove'];
    if (isset($_SESSION['cart'][$MaHP])) {
        unset($_SESSION['cart'][$MaHP]);
    }
}

// Xử lý khi nhấn "Xóa tất cả"
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
}

// Xử lý khi nhấn "Xác nhận" => Lưu vào database
if (isset($_POST['confirm'])) {
    if (!empty($_SESSION['cart'])) {
        $queryDangKy = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), ?)";
        $stmt = $conn->prepare($queryDangKy);
        $stmt->execute([$MaSV]);
        $MaDK = $conn->lastInsertId();

        foreach ($_SESSION['cart'] as $MaHP => $hocphan) {
            $queryCT = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
            $stmt = $conn->prepare($queryCT);
            $stmt->execute([$MaDK, $MaHP]);
        }

        // Xóa session sau khi lưu
        unset($_SESSION['cart']);
        header("Location: chitietdangky.php?success=1");
        exit();
    }
}

// Lấy danh sách học phần từ session
$hocphans = $_SESSION['cart'] ?? [];
$totalTinChi = array_sum(array_column($hocphans, 'SoTinChi'));
?>

<?php include '../templates/header.php'; ?>
<div class="container">
    <h2>Đăng Kí học phần</h2>

    <?php if (isset($_GET['success'])): ?>
        <p class="text-success">Đăng ký học phần thành công!</p>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>MaHP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hocphans as $MaHP => $hp): ?>
            <tr>
                <td><?= $MaHP ?></td>
                <td><?= $hp['TenHP'] ?></td>
                <td><?= $hp['SoTinChi'] ?></td>
                <td>
                    <a href="?remove=<?= $MaHP ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="text-danger">Số lượng học phần: <?= count($hocphans) ?></p>
    <p class="text-danger">Tổng số tín chỉ: <?= $totalTinChi ?></p>

    <a href="?clear=1" class="btn btn-warning">Xóa tất cả</a>
    <button id="btnLuu" class="btn btn-primary">Lưu đăng ký</button>

    <!-- Form xác nhận (ẩn ban đầu) -->
    <form id="confirmForm" method="POST" class="mt-4" style="display: none;">
        <h3>Thông tin Đăng ký</h3>
        <p><strong>Mã số sinh viên:</strong> <?= $MaSV ?></p>
        <p><strong>Họ Tên Sinh Viên:</strong> <?= $HoTen ?></p>
        <p><strong>Ngày Đăng Ký:</strong> <?= date('d/m/Y') ?></p>
        <button type="submit" name="confirm" class="btn btn-success">Xác Nhận</button>
    </form>
</div>

<script>
document.getElementById('btnLuu').addEventListener('click', function() {
    document.getElementById('confirmForm').style.display = 'block';
});
</script>

<?php include '../templates/footer.php'; ?>
