<h2>Edit Data Gejala</h2>
<div class="pull-right">
<a href="index.php?halaman=gejala" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<br>
<?php

$ambil = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label>Kode Gejala</label>
<input type="text" class="form-control" name="kode" value="<?php echo $pecah['kode_gejala'];?>" required>
</div>
<div class="form-group">
<label>Nama Gejala</label>
<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_gejala'];?>" required>
</div>
<div class="form-group">
<label>Nilai Densistas</label>
<input type="float" class="form-control" name="nilai" value="<?php echo $pecah['nilai_ds'];?>" required>
</div>
<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php 
if(isset($_POST['ubah']))
{
    
        $koneksi->query("UPDATE gejala SET kode_gejala='$_POST[kode]',nama_gejala='$_POST[nama]',
        nilai_ds='$_POST[nilai]' WHERE id_gejala='$_GET[id]'");
    
echo "<div class='alert alert-info'>Data Berhasil di ubah</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=gejala'>";
}
?>

