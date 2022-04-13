<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","tokobuku");

	if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
	}

	
	$id_pem = $_GET['id'];
	$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pem'");
	$detpem = $ambil->fetch_assoc();

	
	$id_pelanggan_beli = $detpem['id_pelanggan'];
	$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

	if ($id_pelanggan_login !== $id_pelanggan_beli) {
		echo "<script> alert('Tidak Dapat Mengakses'); </script>";
		echo "<script> location='riwayat.php' </script>";
		exit();

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>


	<body>


    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">

    <style>

      #header .headerBackground{
  width: 1520px;
  height: 250px;
  background: url(img/backround.jpg);
  background-size: cover; 
}

    #header{
      background: blue;
      width: 940px;
      height: 240px;
    }
    h1{
      padding-top: 0px;
    }
    article {
      background-color: white;
    }
  </style>

<body>
  <div id="container">
    <div id="header">
      <div class="headerBackground">
	  <h1><font color="#ff6584"><br><br><b>&nbsp;&nbsp;Andara</font><font color="#ffffff"> Book Store</font></b></h1>
      </div>
    </div>
  <body>


	<nav class="navbar navbar-default" >
		<div class="container" style="background: black;">
			<ul class="nav navbar-nav">
				
				<?php if (isset($_SESSION['pelanggan'])): ?>
				<li><a href="logout.php" onclick="return confirm('Apakah Anda Yakin ?')">Logout</a></li>
				<li><a href="riwayat.php">Riwayat</a></li>
				<?php else: ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="daftar.php">Daftar</a></li>
				<?php endif ?>				
				<li><a href="index.php">Belanja</a></li>
				<?php if(!isset($_SESSION["keranjang"])) : ?>
					<li><a href="keranjang.php">Keranjang<strong>(0)</strong></a></li>
				<?php else : ?>
				<hide>
						<?php $jml=0; ?>
						<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
						<?php $pecah = $ambildata->fetch_assoc(); ?>
						<tr>
							<td><?php $jumlah ?></td>
						</tr>
						<?php $jml += $jumlah; ?>
						<?php endforeach ?>
				</hide>
				<li><a href="keranjang.php">Keranjang<strong>(<?php echo $jml ?>)</strong></a></li>
			<?php endif ?>
				<li><a href="bayar.php">Pembayaran</a></li>
			</ul>
			</ul>
		</div>

		<div class="container">
			<h2>Konfirmasi Pembayaran</h2>
			<p>Kirim Bukti Pembayaran Anda Disini</p>
			<div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem['total_pembelian']); ?></strong></div>

			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama Penyetor</label>
					<input type="text" name="nama" class="form-control" required="" placeholder="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
				</div>
				<div class="form-group">
					<label>Bank</label>
					<input type="text" name="bank" class="form-control" required="">
				</div>
				<div class="form-group">
					<label>Jumlah (Rp.)</label>
					<input type="number" name="jumlah" class="form-control" min="1" required="" placeholder="<?php echo $detpem['total_pembelian']; ?>">
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<input type="file" name="bukti" class="form-control" required="">
					<p class="text-danger">Format Foto Bukti JPG Maksimal 2MB</p>
				</div>
				<button class="btn btn-warning" name="kirim">Kirim</button>
			</form>
		</div>

		<?php 
		if (isset($_POST['kirim'])) {
			
			
			$namabukti = $_FILES['bukti']['name'];
			$lokasibukti = $_FILES['bukti']['tmp_name'];
			$namafiks = date('YmdHis').$namabukti;
			move_uploaded_file($lokasibukti, "bukti_pembayaran/".$namafiks);

			$tanggal = date('Y-m-d');

			$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
				VALUES ('$id_pem','$_POST[nama]','$_POST[bank]','$_POST[jumlah]','$tanggal','$namafiks') ");

			//update data pembelian dari pending menjadi sudah kirim pembayaran
			$koneksi->query("UPDATE pembelian SET status_pembelian = 'Proses' WHERE id_pembelian='$id_pem'");
			echo "<script> alert('Terima Kasih Sudah Memberikan Bukti Pembayaran'); </script>";
			echo "<script> location='riwayat.php' </script>";
			exit();
		}
		?>

</body>
</html>

