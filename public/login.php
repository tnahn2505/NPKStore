<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="css/style2.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>

<body>


<div class="container">
        <div class="row d-flex justify-content-center align-items-center m-0" style="height: 100vh;">
            <div class="login_oueter">
                <div class="col-md-12 logo_outer">
                    <img src="" />
                </div>
                <form action="" method="post" id="login" autocomplete="off" class="bg-light border p-3">
                    <h4 class="my-3 text-center">ĐĂNG NHẬP</h4>
                    <div class="form-row">

                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="username" type="text" value="" class="input form-control" id="username"
                                    placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="password" type="password" value="" class="input form-control" id="password"
                                    placeholder="password" required="true" aria-label="password"
                                    aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group form-check text-left">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember_me" />
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit" name="signin">Đăng nhập</button>
                        </div>
                        <div class="col-sm-12 pt-3 text-right">
                            <p>Bạn chưa có tài khoản ? <a href="#">Đăng ký</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row d-flex justify-content-center align-items-center m-0" style="height: 100vh;">
            <div class="login_oueter">
                <div class="col-md-12 logo_outer">
                    <img src="" />
                </div>
                <form action="" method="post" id="login" autocomplete="off" class="bg-light border p-3">
                    <h4 class="my-3 text-center">TẠO TÀI KHOẢN</h4>
                    <div class="form-row">

                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-envelope"></i></span>
                                </div>
                                <input name="email_register" type="email" value="" class="input form-control"
                                    id="username" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="username" type="text" value="" class="input form-control" id="username"
                                    placeholder="Họ tên" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="password" type="password" value="" class="input form-control"
                                    id="password_register" placeholder="Mật khẩu" required="true" aria-label="password"
                                    aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide_register();">
                                        <i class="fas fa-eye" id="show_eye_register"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye_register"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-check"></i></span>
                                </div>
                                <input name="password" type="password" value="" class="input form-control"
                                    id="password_confirm" placeholder="Xác nhận mật khẩu" required />

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="email_register" type="text" value="" class="input form-control"
                                    id="username" placeholder="Số điện thoại" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-map-marker"></i></span>
                                </div>
                                <input name="email_register" type="text" value="" class="input form-control"
                                    id="username" placeholder="Địa chỉ" />
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit" name="signin">Đăng ký</button>
                        </div>
                        <div class="col-sm-12 pt-3 text-center">
                            <a href="#">Quên mật khẩu</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hide_register() {
            var password = document.getElementById("password_register");
            var password_confirm = document.getElementById("password_confirm");
            var show_eye = document.getElementById("show_eye_register");
            var hide_eye = document.getElementById("hide_eye_register");
            hide_eye.classList.remove("d-none");
            if (password.type === "password") {
                password.type = "text";
                password_confirm.type = "text";

                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                password.type = "password";
                password_confirm.type = "password";

                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }


    </script>

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>