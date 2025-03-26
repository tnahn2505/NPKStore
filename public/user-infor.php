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

<!-- User infor	 -->
<section style="background-color: #eee;">
	<div class="container py-5">
		<div class="row">
			<div class="col">
				<nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
						<li class="breadcrumb-item active" aria-current="page">Tài khoản</li>

					</ol>
				</nav>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4">
				<div class="card mb-4">
					<div class="card-body" >
						<div class="d-flex align-items-center">
							<img src="./layout/img/" alt="avatar" class="rounded-circle img-fluid" style="width: 80px;">
							<div class="ml-2">
								<h6 class="my-2 font-weight-bold"></h6>
								<a href="index.php?page=update-user" style="opacity: 0.6;" class="text-dark font-weight-bold">Sửa hồ sơ</a>
							</div>
						</div>
						
						<div class="row mt-2">
							
							<div class="list-group col-12 p-0" style="border: none;">
								<a href="index.php?page=user-infor" class="list-group-item list-group-item-action">
									
									Hồ sơ
								</a>
								<a href="" class="list-group-item list-group-item-action">Đơn mua</a>
								<a href="" class="list-group-item list-group-item-action">Địa chỉ</a>
								<a href="index.php?page=change-password" class="list-group-item list-group-item-action">Đổi mật khẩu</a>
								<a href="index.php?page=dangxuat" class="list-group-item list-group-item-action">Đăng xuất</a>

							</div>
							
							
						</div>	
						
						
					</div>
				</div>
                
				
			</div>
			<div class="col-lg-8">
				<div class="card mb-4">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Họ tên</p>
							</div>
							<div class="col-sm-9">
								<p class="text-muted mb-0"></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Email</p>
							</div>
							<div class="col-sm-5">
								<p class="text-muted mb-0"></p>
							</div>
							
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Số điện thoại</p>
							</div>
							<div class="col-sm-5">
								
								<p class="text-muted mb-0">0336216546</p>
							</div>
							
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Tên tài khoản</p>
							</div>
							<div class="col-sm-9">
								<p class="text-muted mb-0">khoa123</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Mật khẩu</p>
							</div>
							<div class="col-sm-5">
								
								<!-- <?php $maskedPassword = str_repeat('*', strlen($password)); ?> -->
								<p class="text-muted mb-0"></p>
							</div>
							
							<div class="col-sm-3">
								<a href="index.php?page=change-password" class="text-primary mb-0">Thay đổi</a>
							</div>
							
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<p class="mb-0">Đia chỉ</p>
							</div>
							<div class="col-sm-9">
								<p class="text-muted mb-0">Cần Thơ</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-4 d-flex">
								
								<a href="index.php?page=update-user" class="btn btn-outline-dark btn-rounded mb-4" >Sửa hồ sơ</a>
								<a href="index.php?page=dondamua" class="btn btn-danger btn-rounded mb-4 ml-2" >Đơn mua</a>
									
								
							</div>
						</div>
					</div>
				</div>
				<div class="my-2 text-right">
					<a href="index.php" class="btn btn-success">Trở về trang chủ</a>
				</div>
			</div>

		</div>

	</div>

</section>

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