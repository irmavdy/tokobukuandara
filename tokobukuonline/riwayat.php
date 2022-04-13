<?php session_start(); ?>
<?php $koneksi = new mysqli("localhost","root","","tokobuku"); ?>
<?php 
//jika tidak ada session pelanggan maka tidak bisa diakses
if (!isset($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Pembelian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
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

	
	<nav class="navbar navbar-default" style="background: black;">
		<div class="container">
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

			<form action="pencarian.php" method="get" class="navbar-form navbar-right">
				<input type="text" name="keyword" class="form-control" placeholder="Pencarian">
				<button class="btn btn-primary">Cari</button>
			</form>
		</div>
	</nav>

		
		<section class="riwayat">
			<div class="container">
			<h3><span> Riwayat Pembelian <?php echo $_SESSION['pelanggan']['nama_pelanggan'];?></span>&nbsp;&nbsp;</h3>

			<span><em class="glyphicon glyphicon-folder-open"></em>&nbsp; Riwayat Belanja</span>&nbsp;&nbsp;
                  <span><em class="glyphicon glyphicon-calendar"></em> 7 Juni 2020</span>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pembelian</th>
							<th>Status Pembelian</th>
							<th>Total</th>
							<th>Keterangan</th>
						</tr>
					</thead>

					<tbody>
						<?php $nomor=1; ?>
						<?php 
						
						$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
						
						$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
						while($pecah = $ambil->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['tanggal_pembelian']; ?></td>
							<td><?php echo $pecah['status_pembelian']; ?>
								<br>
								<?php if(!empty($pecah['resi_pengiriman'])): ?>
								No.Resi <?php echo $pecah['resi_pengiriman']; ?>
								<?php endif  ?>
							</td>
							<td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
							<td>
								<a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Nota</a>
								
								<?php if($pecah['status_pembelian']=='Tertunda'): ?>
									<a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-success">Pembayaran</a>
									<?php else: ?>
										<!-- <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-warning">Lihat</a> -->
								<?php endif ?>
							</td>
						</tr>
						<?php $nomor++ ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>

</body>
</html>

