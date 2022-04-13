<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-grup">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-grup">
		<label>Berat (Gr)</label>
		<input type="number" class="form-control" name="berat">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-grup">
		<label>Stok Produk</label>
		<input type="number" class="form-control" name="stok">
	</div>	
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<button class="btn btn-warning" name="save">Simpan</button>
</form>

<?php  
	if (isset($_POST['save'])) {
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto_produk/".$nama);

		$koneksi->query("INSERT INTO produk 
			(nama_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk,resep_produk,stok_produk)
			VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$namaresep','$_POST[stok]')");

		echo "<div class='aler alert-info'>Data Tersimpan</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?hal=produk'>";
	}

?>

