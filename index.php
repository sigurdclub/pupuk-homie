<?php
include_once'./admin/koneksi.php';
$koneksi = Koneksi();
//cek login terdaftar atau tidak
if(isset ($_POST['login'])){
    $username = mysqli_escape_string($koneksi,$_POST['username']);
    $password =mysqli_escape_string($koneksi,$_POST['password']) ;

    //ambil data pada database (query) dan simpan dalam variabel result
    $result = mysqli_query($koneksi, "SELECT * FROM admin_pupuk WHERE username ='$username' && password ='$password'");
    $cek = mysqli_fetch_array($result);
    
    // cek username dan password
    if($cek>0){
        $_SESSION=[
            'iduser'=>$cek['id'],
            'email'=>$cek['username'],
            'password'=>$cek['password'],
        ];
        // setting session
        $_SESSION['log'] = True;
        echo "<script>window.location='./admin/stock_pupuk/stock_pupuk.php';</script>";
    }
    $error = true;
}
// cek jika session sdh dibuat
if(isset($_SESSION['log'])){
    echo "<script>window.location='./admin/stock_pupuk/stock_pupuk.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/loginasst/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/loginasst/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/loginasst/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/loginasst/css/main.css">
<!--===============================================================================================-->
</head>
<body >
	
	<div class="limiter" >
		<div class="container-login100" style="background-color: black;">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST">
					<!-- cek jika username atau password salah -->
					<?php if(isset($error)) : ?>
							<div class="alert alert-danger alert-dismissible">
									Password atau Email Anda Salah!
							</div>
					<?php endif; ?>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/loginasst/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/loginasst/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="assets/loginasst/js/main.js"></script>

</body>
</html>