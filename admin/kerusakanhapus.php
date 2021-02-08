<?php

$ambil = $koneksi->query("SELECT * FROM kerusakan WHERE id_kerusakan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM kerusakan WHERE id_kerusakan='$_GET[id]'");

echo "<div class='alert alert-info'>Kerusakan Terhapus</div>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kerusakan'>";

?>
