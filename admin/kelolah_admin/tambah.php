<?php
// include_once "../koneksi.php";
// $koneksi = Koneksi();
// if(isset($_POST['tambah'])){

//     if(barangKeluar($_POST)>0){
//     echo "
//         <script>
//             alert('data berhasil ditambah!');
//             document.location.href = 'barang_keluar.php';
//         </script>";
//   }else{
//     echo "
//       <script>
//           alert('data gagal ditambah!');
//           document.location.href = 'barang_keluar.php';
//       </script>";
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">

<!-- css mind -->
<link rel="stylesheet" href="../../style.css">
<!-- css bootsrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<!-- Preloader
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand " style="background-color: #D7A86E;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    
    <!-- Messages Dropdown Menu -->
    
    <!-- Notifications Dropdown Menu -->
    
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #8E3200;">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link" style="text-decoration: unset;">
    <!-- <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <h4 class="brand-text font-weight-light text-title" style="text-align: center;">Pupuk Homie</h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class=" mt-3 ">
        <div class="image">
        <img src="../../assets/images/profile icon.png" class="img-circle elevation-2  mx-auto d-block" alt="User Image" width="70%">
        </div>
        <div class="info" style="margin-top: 5%;">
        <a href="#" class="d-block" style="text-decoration: unset;"><p style="margin: unset; text-align: center; color: white;">Rensa</p></a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        
        <hr style="margin-top: 10%;"> 
        <li class="nav-item" style="padding: 5px;">
            <a href="../stock_barang/stock_barang.php" class="nav-link">
            <i class="nav-icon fas fa-ellipsis-h"></i>
            <p>Stock barang</p>
            </a>
        </li>
        <li class="nav-item" style="padding: 5px;">
            <a href="../barang_masuk/barang_masuk.php" class="nav-link">
            <i class="nav-icon fas fa-ellipsis-h"></i>
            <p>Barang Masuk</p>
            </a>
        </li>
        <li class="nav-item" style="padding: 5px;">
            <a href="../barang_keluar/barang_keluar.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Barang Keluar</p>
            </a>
        </li>
        <li class="nav-item" style="padding: 5px;">
            <a href="../kelolah_admin/kelolah_admin.php" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Kelolah Admin</p>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #D7A86E;">

    <div class="content-header">
    <div class="container-fluid">
    
        <div class="">
            <h1 class="m-0" style="text-align: center; color: black;">Tambah Admin</h1>
        </div>
    
    </div>
    </div>
    <!-- Last Content -->

    <!-- Isi konten -->
        <div class="container-fluid">
        <div class="row" style="justify-content: center;width: 100%;" >
<div class="card card-stock-barang" style="width: 50%; background-color: #8E3200;">
    <div class="card-body">
    <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
    <div class="col-12">
        <label for="inputAddress" class="form-label">Username</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="username..." name="username" required>
    </div>
    <div class="col-12">
        <label for="inputAddress2" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputAddress2" placeholder="password...." name="password" required>
    </div>
    <div class="col-12" style="display: flex; justify-content: right;">
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
    </div>
    </form>
    </div>
</div>
</div>
            
        </div>
    <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer" style="background-color: #D7A86E;">
    <div class="float-right d-none d-sm-inline-block">
    <b style="color: black;">@SigurdClub</b> <span style="color: black;">25.04.22</span>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../assets/plugins/raphael/raphael.min.js"></script>
<script src="../../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../assets/dist/js/pages/dashboard2.js"></script>

<!-- javascript bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>





