<?php
session_start();
include("koneksi.php");

$result = mysqli_query($conn, "SELECT * FROM pengunjung WHERE waktu_kunjung > DATE_SUB(NOW(), INTERVAL 1 DAY)");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Peminjaman Buku & Data Pengunjung</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">PENDATAAN</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <?php if(isset($_SESSION["akun"])): ?>
          <?php if($_SESSION["role"]=="Admin"): ?>
            <li class="nav-item">
              <a class="nav-link text-white " href="pengunjung.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">person</i>
                </div>
                <span class="nav-link-text ms-1">Data Pengunjung</span>
              </a>
            </li>
          <?php endif ?>
          <li class="nav-item">
            <a class="nav-link text-white " href="peminjaman.php">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">book</i>
              </div>
              <?php if($_SESSION["role"]=="Admin"): ?>
                <span class="nav-link-text ms-1">Data Peminjaman</span>
              <?php else: ?>
                <span class="nav-link-text ms-1">Peminjaman</span>
              <?php endif ?>
            </a>
          </li>
          <?php if($_SESSION["role"]=="Admin"): ?>
            <li class="nav-item">
              <a class="nav-link text-white " href="buku.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">book</i>
                </div>
                <span class="nav-link-text ms-1">Data Buku</span>
              </a>
            </li>
          <?php endif ?>
        <?php endif ?>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="">
          <?php if(isset($_SESSION["akun"])): ?>
            <a>
              <div class="text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
                <span class="nav-link-text ms-1"><?=$_SESSION["akun"]?> (<?=$_SESSION["role"]?>) /&nbsp;<a href="logout.php">Logout</a></span>
              </div>
            </a>
          <?php else: ?>
            <a href="login.php">
              <div class="text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
                <span class="nav-link-text ms-1">Masuk&nbsp;/&nbsp;<a href="daftar.php">Daftar</a></span> 
              </div>
            </a>
          <?php endif ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <img src="assets/img/bg-sekolah.jpg" alt="" width="100%" height="400px">
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="container">
                      <div class="row">
                          <div class="col-6 align-self-center">
                              <img src="assets/img/kepsek.jpg" alt="" height="400px">
                          </div>
                          <div class="col-6">
                              <div class="card">
                                  <div class="card-body">
                                      <h3 class="card-title">Suharni Mursidi</h3>
                                      <p class="card-text">Sebagai Kepala Sekolah SDN Muara Arai</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="container">
                      <div class="row">
                          <div class="col-6 align-self-center">
                              <img src="assets/img/keppes.jpg" alt="" height="400px">
                          </div>
                          <div class="col-6">
                              <div class="card">
                                  <div class="card-body">
                                      <h3 class="card-title">Mursidi</h3>
                                      <p class="card-text">Sebagai Kepala Perpustakaan SDN Muara Arai</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <?php if(@$_SESSION["role"] == "Admin"): ?>
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Pengunjung Hari Ini</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pengunjung</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Kunjung</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($pengunjung = mysqli_fetch_array($result)): ?>
                        <tr>
                          <td class="align-middle text-center">
                            <h6 class="mb-0 text-sm"><?=$pengunjung["nama_pengunjung"]?></h6>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0"><?=$pengunjung["keterangan"]?></p>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?=$pengunjung["waktu_kunjung"]?></span>
                          </td>
                        </tr>
                      <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>
      
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>