<?php
    session_start();
    
    $koneksi = new mysqli("localhost","root","","tokobuku");
    if (!isset($_SESSION['admin'])) {
        echo "<script> alert('Anda Belum Login, Silahkan Tekan Ok Untuk Login'); </script>";
        echo "<script> location='login.php'; </script>";
        exit();
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Admin</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                        </button>
                <a class="navbar-brand" style="background: #ff6584; color: white">Halaman Admin</a> 
            </div>
  <div
   style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="index.php?hal=logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
                <nav class="navbar-default navbar-side " role="navigation">
            <div class="sidebar-collapse" style="background: #f9fafa; color: white">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                <img src="assets/img/logo.png" width="160px" height="128px" class="user-image img-responsive"/>
					</li>
                    <li><a href="index.php"><i class="fa fa-home "></i> Admin</a></li>
                    <li><a href="index.php?hal=produk"><i class="fa fa-book "></i> Buku</a></li>
                    <li><a href="index.php?hal=pembeli"><i class="fa fa-shopping-cart"></i> Pembeli</a></li>
                    <li><a href="index.php?hal=pelanggan"><i class="fa fa-user"></i> Pelanggan</a></li>
                </ul>
            </div>
              </nav>  

        <div id="page-wrapper" >
            <div id="page-inner">
                <?php  
                    if (isset($_GET['hal'])) {
                        if ($_GET['hal']=="produk") {
                            include 'produk.php';
                        }
                        elseif ($_GET['hal']=="pembeli") {
                            include 'pembeli.php';
                        }
                        elseif ($_GET['hal']=="pelanggan") {
                            include 'pelanggan.php';
                        }
                        elseif ($_GET['hal']=="hapuspelanggan") {
                            include 'hapuspelanggan.php';
                        }
                        elseif ($_GET['hal']=="ubahpelanggan") {
                            include 'ubahpelanggan.php';
                        }
                        elseif ($_GET['hal']=="detail") {
                            include'detail.php';
                        }
                        elseif ($_GET['hal']=="tambahproduk") {
                            include'tambahproduk.php';
                        }
                        elseif ($_GET['hal']=="hapusproduk") {
                            include 'hapusproduk.php';
                        }
                        elseif($_GET['hal']=="ubahproduk") {
                            include 'ubahproduk.php';
                        }
                        elseif ($_GET['hal']=="logout") {
                            include 'logout.php';
                        }
                        elseif ($_GET['hal']=="pembayaran") {
                            include 'pembayaran.php';
                        }
                        elseif ($_GET['hal']=="laporan_pembelian") {
                            include 'laporan_pembelian.php';
                        }
                    }
                    else {
                        include'home.php';
                    }
                ?>
            </div>
            </div>
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
