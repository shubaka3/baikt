<?php
require_once __DIR__ . '/../config/database.php';

class SinhVien {
    private $conn;
    private $table_name = "SinhVien";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "INSERT INTO " . $this->table_name . " (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh]);
    }

    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "UPDATE " . $this->table_name . " SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh, $MaSV]);
    }

    public function delete($MaSV) {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaSV]);
    }

    public function login($MaSV) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
