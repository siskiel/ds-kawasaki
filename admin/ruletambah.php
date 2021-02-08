<h2>Tambah Rule Base</h2>
<div class="pull-right">
<a href="index.php?halaman=rule" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<br>

<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="gejala">Nama Gejala</label>
<select name="gejala" id="gejala" class="form-control" required>
	<option value=""> - Pilih -</option>
	<?php  
	$ambilgejala = $koneksi->query("SELECT * FROM gejala");
	while($pecah = $ambilgejala->fetch_assoc()) {
		echo '<option value="'.$pecah['id_gejala'].'">'.$pecah['nama_gejala'].'</option>';
	}
	?>
</select>
</div>
<div class="form-group">
<label>Nama Kerusakan</label>
<select name="kerusakan" id="kerusakan" class="form-control" required>
	<option value=""> - Pilih -</option>
	<?php  
	$ambilkerusakan = $koneksi->query("SELECT * FROM kerusakan");
	while($pecah = $ambilkerusakan->fetch_assoc()) {
		echo '<option value="'.$pecah['id_kerusakan'].'">'.$pecah['nama_kerusakan'].'</option>';
	}
	?>
</select>
</div>
<div class="form-group pull-right">
<button class="btn btn-default " name="rest" type="reset" >Reset</button>
<button class="btn btn-success " name="save">Simpan</button>
</form>
<?php 
if(isset($_POST['save']))
{
    
    $koneksi->query("INSERT INTO rule (id_gejala,id_kerusakan) VALUES('$_POST[gejala]','$_POST[kerusakan]')");
    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=rule'>";
}
?>
