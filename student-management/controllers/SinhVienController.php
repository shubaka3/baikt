<?php
require_once __DIR__ . '/../models/SinhVien.php';

class SinhVienController {
    private $model;

    public function __construct() {
        $this->model = new SinhVien();
    }

    public function index() {
        return $this->model->getAll();
    }

    public function detail($id) {
        return $this->model->getById($id);
    }

    public function create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->model->create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }

    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->model->update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }

    public function delete($MaSV) {
        return $this->model->delete($MaSV);
    }
}
?>
