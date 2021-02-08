<h2>Edit Data Basis Pengetahuan</h2>

<div class="pull-right">
<a href="index.php?halaman=rule" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<br>
<?php

$ambil = $koneksi->query("SELECT * FROM rule WHERE id_rule='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="gejala">Nama Gejala</label>
<select name="gejala" id="gejala" class="form-control" required>
	<?php  
	$ambilgejala = $koneksi->query("SELECT * FROM gejala");
	while($pecah = $ambilgejala->fetch_assoc()) {
		echo '<option value="'.$pecah['id_gejala'].'">'.$pecah['nama_gejala'].'</option>';
	}
	?>
</select>
</div>
<div class="form-group">
<label>Nama kerusakan</label>
<select name="kerusakan" id="kerusakan" class="form-control" required>
	<?php  
	$ambilkerusakan = $koneksi->query("SELECT * FROM kerusakan");
	while($pecah = $ambilkerusakan->fetch_assoc()) {
		echo '<option value="'.$pecah['id_kerusakan'].'">'.$pecah['nama_kerusakan'].'</option>';
	}
	?>
</select>
</div>
<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php 
if(isset($_POST['ubah']))
{
    
        $koneksi->query("UPDATE rule SET id_gejala='$_POST[gejala]',
        id_kerusakan='$_POST[kerusakan]' WHERE id_rule='$_GET[id]'");
    
echo "<div class='alert alert-info'>Data Berhasil di ubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=rule'>";
}
?>

