<?php
// Đảm bảo đã load model
require_once 'models/CustomerModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $user = $CustomerModel->get_user_by_username($username);
        if ($user && isset($user[0]['password'])) {
            if ($user[0]['active'] != 1) {
                echo json_encode(['success' => false, 'message' => 'Tài khoản đã bị khóa']);
            } else {
                if (password_verify($password, $user[0]['password'])) {
                    // Lưu thông tin đăng nhập vào session
                    $_SESSION['user'] = [
                        'id' => $user[0]['user_id'],
                        'username' => $user[0]['username'],
                        'full_name' => $user[0]['full_name'],
                        'image' => $user[0]['image'],
                        'email' => $user[0]['email'],
                        'phone' => $user[0]['phone'],
                        'address' => $user[0]['address'],
                    ];
                    echo json_encode(['success' => true, 'message' => 'Đăng nhập thành công']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Sai tên tài khoản hoặc mật khẩu']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Sai tên tài khoản hoặc mật khẩu']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
    }
}
?>
