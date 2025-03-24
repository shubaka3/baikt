<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Quản lý Sinh Viên</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php if (isset($_SESSION['MaSV'])): ?>
                <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="hocphan_dangky.php">Học Phần Đã Đăng Ký</a></li>
                <li class="nav-item"><a class="nav-link" href="list.php">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="create.php">Thêm sinh viên</a></li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="logout.php">Đăng xuất</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Đăng nhập</a>
                </li>
            <?php endif; ?> 
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">