<?php
session_start(); // Bắt đầu session
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit();
}

include 'CustomerModel.php';

// Kiểm tra và lấy user_id
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo "Không có thông tin tài khoản.";
    exit;
}

$user_id = $_GET['user_id'];
$user = $CustomerModel->select_user_by_id($user_id);

// Kiểm tra tài khoản có tồn tại không
if (!$user) {
    echo "Tài khoản không tồn tại!";
    exit;
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <h2 class="text-center">Thông tin tài khoản</h2>
        <form class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user['username']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Họ và tên:</label>
                <input type="text" class="form-control" id="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" value="<?= htmlspecialchars($user['phone']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" value="<?= htmlspecialchars($user['address']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Vai trò:</label>
                <input type="text" class="form-control" id="role" 
                    value="<?= $user['role'] == 0 ? 'Khách hàng' : 'Nhân viên' ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Trạng thái hoạt động:</label>
                <input type="text" class="form-control" id="active" 
                    value="<?= $user['active'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>" readonly>
            </div>
            <div class="mb-3 text-center">
                <img src="../upload/<?= htmlspecialchars($user['image']) ?>" alt="Ảnh đại diện" class="img-thumbnail" style="max-width: 150px;">
            </div>
            <div class="text-center">
                <a href="admin.php?quanli=danh-sach-khach-hang" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>
<style>
    td {
        height: 50px;
    }
</style>
