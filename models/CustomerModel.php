<?php
    class CustomerModel {
        private $pdo;
        public function __construct() {
            $this->pdo = pdo_get_connection(); // Sử dụng hàm pdo_get_connection() đã khai báo
        }
        public function select_users() {
            $sql = "SELECT username, full_name, email, phone FROM users";
            return pdo_query($sql);
        }


        public function HandleLogout(){

            return "index.php?url=dang-xuat";


        }

        public function select_email_in_users($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        

        public function user_insert($username, $password, $full_name, $image, $email, $phone, $address) {
            $sql = "INSERT INTO users(username, password, full_name, image, email, phone, address) VALUES(?,?,?,?,?,?,?)";
            pdo_execute($sql, $username, $password, $full_name, $image, $email, $phone, $address);
        }
    
        public function get_user_by_username($username) {
            $sql = "SELECT * FROM users WHERE username = ?";
            return pdo_query($sql, $username);
        }
    
        public function update_password($new_password, $user_id) {
            $sql = "UPDATE users SET password = ? WHERE user_id = ?";
            pdo_execute($sql, $new_password, $user_id);
        }
    
        public function reset_password($new_password, $email) {
            $sql = "UPDATE users SET password = ? WHERE email = ?";
            pdo_execute($sql, $new_password, $email);
        }
    
        public function update_user($full_name, $address, $phone, $image, $user_id) {
            $sql = "UPDATE users SET 
                full_name = '".$full_name."',";
    
            if ($image != '') {
                $sql .= " image = '".$image."',";
            }
    
            $sql .= " address = '".$address."', phone = '".$phone."'
                        WHERE user_id = ".$user_id;
    
            pdo_execute($sql);
        }
    
        public function update_recovery_token($email, $token) {
            $stmt = $this->pdo->prepare("
                UPDATE users 
                SET recovery_token = :token, 
                    token_expiry = NOW() + INTERVAL 30 MINUTE 
                WHERE email = :email
            ");
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            return $stmt->execute();
        }

        //check login by username from databasedatabase
        public function handleSignin($postData, $adminCredentials) {
            $error = '';
            $username_tmp = '';
            $password_tmp = '';
        
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($postData["signin"])) {
                $username = trim($postData["username_login"]);
                $password = trim($postData["password_login"]);
        
                // Kiểm tra các trường hợp nhập sai
                if (empty($username)) {
                    $error = 'Tên đăng nhập không được để trống';
                } elseif (empty($password)) {
                    $error = 'Mật khẩu không được để trống';
                } else {
                    // Kiểm tra thông tin đăng nhập với thông tin admin đã định nghĩa
                    if ($username === $adminCredentials['username'] && $password === $adminCredentials['password']) {
                        $_SESSION['user_admin'] = $username;
                        header(header: "Location: admin/index.php");
                        exit();
                    } else {
                        // Kiểm tra thông tin đăng nhập user từ cơ sở dữ liệu
                        $user = $this->get_user_by_username($username);
                        if ($user && isset($user[0]['password'])) {
                                if (password_verify($password, $user[0]['password'])) {
                                    // Lưu thông tin đăng nhập user vào Session
                                    $_SESSION['user'] = [
                                        'id' => $user[0]['user_id'],
                                        'username' => $user[0]['username'],
                                        'full_name' => $user[0]['full_name'],
                                        'image' => $user[0]['image'],
                                        'email' => $user[0]['email'],
                                        'phone' => $user[0]['phone'],
                                        'address' => $user[0]['address'],
                                    ];
        
                                    if (isset($_SESSION['user_register'])) unset($_SESSION['user_register']);
        
                                    header("Location: index.php");
                                    exit();
                                } else {
                                    $error = 'Sai tên tài khoản hoặc mật khẩu';
                                }
                            }
                         else {
                            $error = 'Sai tên tài khoản hoặc mật khẩu';
                            $username_tmp = $username;
                            $password_tmp = $password;
                        }
                    }
                }
            }
        
            return ['error' => $error, 'username_tmp' => $username_tmp, 'password_tmp' => $password_tmp];
        }
        

        //login adminadmin
        public function getAdminCredentials() {
            return [
                'username' => 'admin', // Đặt tên đăng nhập admin ở đây
                'password' => 'admin123' // Đặt mật khẩu admin ở đây
            ];
        }
        
        //register function
        public function handleRegister($postData, $list_users) {
            $error = [];
            $data = [];
        
            // Lấy dữ liệu từ form
            $data['email'] = trim($postData["email_register"]);
            $data['full_name'] = trim($postData["full_name"]);
            $data['username'] = trim($postData["username"]);
            $data['password'] = trim($postData["password"]);
            $data['password_confirm'] = trim($postData["password_confirm"]);
            $data['phone'] = trim($postData["phone"]);
            $data['address'] = trim($postData["address"]);
            $data['image'] = "user-default.png";
        
            // Mã hóa password
            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        
            // Kiểm tra các trường không được để trống
            if (empty($data['email'])) {
                $error['email'] = 'Email không được để trống.';
            }
            if (empty($data['full_name'])) {
                $error['full_name'] = 'Họ tên không được để trống.';
            }
            if (empty($data['username'])) {
                $error['username'] = 'Tên đăng nhập không được để trống.';
            }
            if (empty($data['password'])) {
                $error['password'] = 'Mật khẩu không được để trống.';
            }
            if (empty($data['password_confirm'])) {
                $error['password_confirm'] = 'Nhập lại mật khẩu không được để trống.';
            }
            if (empty($data['phone'])) {
                $error['phone'] = 'Số điện thoại không được để trống.';
            }
            if (empty($data['address'])) {
                $error['address'] = 'Địa chỉ không được để trống.';
            }
        
            // Kiểm tra email
            if (!empty($data['email'])) {
                foreach ($list_users as $user) {
                    if ($user['email'] == $data['email']) {
                        $error['email'] = 'Email đã được đăng ký.';
                        break;
                    }
                }
                if (strlen($data['email']) > 255) {
                    $error['email'] = 'Email không được quá 255 ký tự.';
                }
            }
        
            // Kiểm tra họ tên
            if (!empty($data['full_name']) && strlen($data['full_name']) > 255) {
                $error['full_name'] = 'Họ tên không được quá 255 ký tự.';
            }
        
            // Kiểm tra tên đăng nhập
            if (!empty($data['username'])) {
                foreach ($list_users as $user) {
                    if ($user['username'] == $data['username']) {
                        $error['username'] = 'Tên đăng nhập đã được đăng ký.';
                        break;
                    }
                }
            }
        
            // Kiểm tra số điện thoại
            if (!empty($data['phone'])) {
                foreach ($list_users as $user) {
                    if ($user['phone'] == $data['phone']) {
                        $error['phone'] = 'Số điện thoại đã được đăng ký.';
                        break;
                    }
                }
                if (!preg_match('/^(03|05|07|08|09)\d{8}$/', $data['phone'])) {
                    $error['phone'] = 'Số điện thoại không đúng định dạng.';
                }
            }
        
            // Kiểm tra mật khẩu
            if (!empty($data['password'])) {
                if ($data['password'] != $data['password_confirm']) {
                    $error['password_confirm'] = 'Nhập lại mật khẩu không trùng khớp.';
                }
                if (strlen($data['password']) < 8) {
                    $error['password'] = 'Mật khẩu phải chứa ít nhất 8 ký tự.';
                }
            }
        
            // Kiểm tra địa chỉ
            if (!empty($data['address']) && strlen($data['address']) > 255) {
                $error['address'] = 'Địa chỉ không được quá 255 ký tự.';
            }
        
            // Nếu không có lỗi, thêm người dùng mới
            if (empty(array_filter($error))) {
                $this->user_insert(
                    $data['username'], 
                    $hashed_password, 
                    $data['full_name'], 
                    $data['image'], 
                    $data['email'], 
                    $data['phone'], 
                    $data['address']
                );
                $_SESSION['user_register'] = [
                    'username' => $data['username'],
                    'password' => $data['password']
                ];
                return [
                    'success' => true,
                    'redirect' => 'index.php?url=dang-nhap'
                ];
            }
        
            // Trả lại lỗi và dữ liệu tạm thời
            return [
                'success' => false,
                'error' => $error,
                'data_tmp' => $data
            ];
        }
        
        
        //forgot password
        public function handlePasswordRecovery($email) {
            $error = '';
            $success = '';
            
            if (empty($email)) {
                $error = 'Email không được để trống';
            } else {
                // Kiểm tra email có tồn tại không
                $result = $this->select_email_in_users($email);
                if ($result === false) {
                    $error = 'Email không tồn tại';
                } else {
                    // Tạo token ngẫu nhiên
                    $token = bin2hex(random_bytes(50));
    
                    // Cập nhật token vào cơ sở dữ liệu
                    $updateResult = $this->update_recovery_token($email, $token);
                    if (!$updateResult) {
                        $error = 'Không thể tạo token khôi phục mật khẩu.';
                    } else {
                        // Gửi email khôi phục mật khẩu
                        $emailSent = $this->sendPasswordRecoveryEmail($email, $token);
    
                        if ($emailSent) {
                            $success = 'Chúng tôi vừa gửi 1 email khôi phục mật khẩu cho bạn. Vui lòng kiểm tra email.';
                            setcookie('token', $token, time() + 1800, '/');
                        } else {
                            $error = 'Không thể gửi email. Vui lòng thử lại sau.';
                        }
                    }
                }
            }
            
            return ['error' => $error, 'success' => $success];
        }
        public function sendPasswordRecoveryEmail($email, $token) {
            // Define recovery URL
            // define('URL_RECOVERY', 'http://localhost/DUAN1_LAPTOP');
            $title = 'Khôi phục mật khẩu NPK';
            $recoveryLink = URL_RECOVERY . 'khoi-phuc-mat-khau&email=' . $email . '&token=' . $token;
    
            // Prepare email content using a view file (e.g., thems-email.php)
            include "views/user/thems-email.php"; // Assuming this contains a variable $html_forgot_password
    
            // Send the email using the sendEmail function (you should define this function in PHPMailer/send-mail.php)
            return sendEmail($email, $title, $html_forgot_password);
        }
        



         // Function to handle password reset
         public function handlePasswordReset($email, $new_password, $confirm_password) {
            $error = array(
                'new_password' => '',
                'confirm_password' => ''
            );
            $temp = ''; // Temporary variable to store password if needed

            // Validate new password
            if(empty($new_password)) {
                $error['new_password'] = 'Mật khẩu không được để trống.';
            }

            if(strlen($new_password) > 255) {
                $error['new_password'] = 'Mật khẩu mới tối đa 255 ký tự';
            }

            if(strlen($new_password) < 8) {
                $error['new_password'] = 'Mật khẩu chứa ít nhất 8 ký tự, không được chứa các ký tự đặc biệt.';
            }

            // Validate confirm password
            if(empty($confirm_password)) {
                $error['confirm_password'] = 'Nhập lại mật khẩu không được để trống.';
            }

            if(strlen($confirm_password) > 255) {
                $error['confirm_password'] = 'Tối đa 255 ký tự';
            }

            if($new_password !== $confirm_password) {
                $error['confirm_password'] = 'Nhập lại mật khẩu không được khác mật khẩu.';
                $temp = $new_password; // Store the new password if confirmation fails
            }

            // If no errors, proceed to update the password
            if(empty(array_filter($error))) {
                try {
                    // Hash the new password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    // Update the password in the database
                    $this->reset_password($hashed_password, $email);
                    // Clear the cookies
                    setcookie('otp', '', time() + 1, '/');
                    setcookie('token', '', time() + 1, '/');
                    return [
                        'success' => 'Đặt lại mật khẩu thành công.'
                    ];
                } catch (Exception $e) {
                    return [
                        'error' => 'Thay đổi mật khẩu thất bại: ' . $e->getMessage()
                    ];
                }
            }

            // Return errors if validation fails
            return [
                'error' => $error,
                'new_password_temp' => $temp
            ];
        }



        //change pass
        // In your CustomerModel.php (or equivalent model file)

        public function get_user_password($user_id) {
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE user_id = ?");
            $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $user ? $user['password'] : null; // Return password if user exists, otherwise null
        }
    
        // Refactored change_password method
        public function change_password($user_id, $password_old, $new_password, $confirm_new_password) {
            $error = array(
                'password_old' => '',
                'new_password' => '',
                'confirm_new_password' => '',
            );
    
            // Step 1: Validate old password
            $password_current = $this->get_user_password($user_id); // Fetch current password from database
            if (!$password_current || !password_verify($password_old, $password_current)) {
                $error['password_old'] = 'Mật khẩu cũ không chính xác';
            }
    
            // Step 2: Validate new password
            if (empty($new_password) || strlen($new_password) < 8) {
                $error['new_password'] = 'Mật khẩu mới tối thiểu 8 ký tự';
            }
    
            if ($new_password !== $confirm_new_password) {
                $error['confirm_new_password'] = 'Nhập lại mật khẩu không trùng khớp với mật khẩu mới';
            }
    
            // Step 3: If no errors, update password
            if (empty(array_filter($error))) {
                try {
                    // Hash new password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->update_password($hashed_password, $user_id); // Update password in database
    
                    return ['success' => true, 'message' => 'Mật khẩu đã được thay đổi thành công.'];
                } catch (Exception $e) {
                    return ['success' => false, 'message' => 'Có lỗi khi thay đổi mật khẩu: ' . $e->getMessage()];
                }
            } else {
                return ['success' => false, 'errors' => $error];
            }
        }



    }

    $CustomerModel = new CustomerModel();
?>