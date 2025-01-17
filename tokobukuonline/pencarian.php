<?php $koneksi = new mysqli("localhost","root","","tokobuku"); ?>
<?php 

	$keyword = $_GET['keyword'];

	$semuadata = array();
	$ambildata = $koneksi-> query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
	while($pecah = $ambildata->fetch_assoc()) {
		$semuadata[]=$pecah;	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pencarian</title>
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

	<div class="container">
		<h1>Hasil Pencarian : <?php echo $keyword ?></h1>
		<?php if(empty($semuadata)):?>
			<div class="alert alert-danger"><?php echo $keyword ?> Tidak Ditemukan</div>
		<?php endif ?>
		<div class="row">

			<?php foreach($semuadata as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value['foto_produk']; ?>">
						<div class="caption">
							<h3> <?php echo $value['nama_produk']; ?></h3>
							<h5>Stok ( <strong><?php echo $value['stok_produk'] ?></strong> ) </h5>
							<h5> Rp. <?php echo number_format($value['harga_produk']); ?></h5>
							<a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-warning">Detail</a>
						</div>
				</div>
			</div>
			<?php endforeach ?>

		</div>
	</div>

</body>
</html>