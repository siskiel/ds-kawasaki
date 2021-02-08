<h2>Edit Data Kerusakan</h2>

<div class="pull-right">
<a href="index.php?halaman=kerusakan" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<br>
<?php

$ambil = $koneksi->query("SELECT * FROM kerusakan WHERE id_kerusakan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>


<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Kerusakan</label>
			<input type="text" class="form-control" name="kode" value="<?php echo $pecah['kode_kerusakan'];?>">
	</div>
	<div class="form-group">
		<label>Nama Kerusakan</label>
			<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_kerusakan'];?>">
	</div>
	<div class="form-group">
		<label>Solusi</label>
			<input type="text" class="form-control" name="solusi" value="<?php echo $pecah['solusi'];?>">
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php 
if(isset($_POST['ubah']))
{
    
        $koneksi->query("UPDATE kerusakan SET nama_kerusakan='$_POST[nama]',
        kode_kerusakan='$_POST[kode]',solusi='$_POST[solusi]' WHERE id_kerusakan='$_GET[id]'");
    
echo "<div class='alert alert-info'>Data Berhasil di ubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kerusakan'>";
}
?>

