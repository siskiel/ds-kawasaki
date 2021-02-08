<h2>Tambah Kerusakan</h2>

<div class="pull-right">
	<a href="index.php?halaman=kerusakan" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<br>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Kerusakan</label>
			<input type="text" class="form-control" name="kode" required>
	</div>
	<div class="form-group">
		<label>Nama Kerusakan</label>
			<input type="text" class="form-control" name="nama" required>
	</div>
	<div class="form-group">
		<label>Solusi</label>
			<input type="text" class="form-control" name="solusi">
	</div>
	<div class="form-group pull-right">
		<button class="btn btn-default " name="rest" type="reset" >Reset</button>
		<button class="btn btn-success" name="save">Simpan</button>
	</div>
</form>
<?php 
if(isset($_POST['save']))
{
    
    $koneksi->query("INSERT INTO kerusakan (kode_kerusakan,nama_kerusakan,solusi) VALUES('$_POST[kode]','$_POST[nama]','$_POST[solusi]')");

    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kerusakan'>";
}
?>
