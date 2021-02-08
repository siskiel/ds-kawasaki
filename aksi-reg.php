<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Expert System | Perhitungan Konsultasi </title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="assets/hasil-konsultasi/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/hasil-konsultasi/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<div class="card">
			<div class="card-header">
			<h3 class="card-title">Gejala Yang Dipilih :</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-0">
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="width: 10%">No</th>
							<th style="width: 20%">Kode Gejala</th>
							<th style="width: 60%">Nama Gejala</th>
							<th style="width: 10%">Nilai Densitas</th>
						</tr>
					</thead>
					<tbody>
					<?php include('config/koneksi.php') ?>

					<?php
						$pilihan_user = [];
						$no = 1;
						foreach ($_POST['id_gejala'] as $key => $value) {
							if($value > 0):
								$result = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='".$key."'");
								while($row = mysqli_fetch_array($result)):
									echo "<tr>";
									echo "<td>" . $no . "</td>";
									echo "<td>" . $row['kode_gejala'] . "</td>";
									echo "<td>" . $row['nama_gejala'] . "</td>";
									echo "<td>" . $row['nilai_ds'] . "</td>";

									$no+=1;
								endwhile;
							endif;
						}
					?>
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
			</div>

			<hr style="border-top: 2px solid black;">

			<?php
				if(isset($_POST['submit'])) {
					// gejala yg dipilih user
					$pilihan_user = [];
					foreach ($_POST['id_gejala'] as $key => $value) {
						if($value > 0):
							$pilihan_user[] = $key;
						endif;
					}

					$sql = "SELECT GROUP_CONCAT(kerusakan.kode_kerusakan), gejala.nilai_ds FROM rule JOIN kerusakan ON rule.id_kerusakan = kerusakan.id_kerusakan JOIN gejala ON rule.id_gejala = gejala.id_gejala WHERE rule.id_gejala IN (".implode(',',$pilihan_user).") GROUP BY rule.id_gejala";
					$result=$koneksi->query($sql);
					$gejala=array();
					while($row=$result->fetch_row()){
						$gejala[]=$row;
					}
					
					//--- menentukan environement
					$sql="SELECT GROUP_CONCAT(kerusakan.kode_kerusakan) FROM kerusakan";
					$result=$koneksi->query($sql);
					$row=$result->fetch_row();
					$fod=$row[0];
					
					//-- masukkan kode perhitungannya di sini
					//--- menentukan nilai densitas
					$densitas_baru=array();
					while(!empty($gejala)){
						$densitas1[0]=array_shift($gejala);
						$densitas1[1]=array($fod,1-$densitas1[0][1]);
						$densitas2=array();
						if(empty($densitas_baru)){
							$densitas2[0]=array_shift($gejala);
						}else{
							foreach($densitas_baru as $k=>$r){
								if($k!="&theta;"){
									$densitas2[]=array($k,$r);
								}
							}
						}
						$theta=1;
						foreach($densitas2 as $d) $theta-=$d[1];
						$densitas2[]=array($fod,$theta);
						$m=count($densitas2);
						$densitas_baru=array();
						for($y=0;$y<$m;$y++){
							for($x=0;$x<2;$x++){
								if(!($y==$m-1 && $x==1)){
									$v=explode(',',$densitas1[$x][0]);
									$w=explode(',',$densitas2[$y][0]);
									sort($v);
									sort($w);
									$vw=array_intersect($v,$w);
									if(empty($vw)){
										$k="&theta;";
									}else{
										$k=implode(',',$vw);
									}
									if(!isset($densitas_baru[$k])){
										$densitas_baru[$k]=$densitas1[$x][1]*$densitas2[$y][1];
									}else{
										$densitas_baru[$k]+=$densitas1[$x][1]*$densitas2[$y][1];
									}
								}
							}
						}
						foreach($densitas_baru as $k=>$d){
							if($k!="&theta;"){
								$densitas_baru[$k]=$d/(1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0));
							}
						}
						// echo "<pre>"; print_r($densitas_baru);
					}
					
					//--- perangkingan
					unset($densitas_baru["&theta;"]);
					arsort($densitas_baru);
					
					//--- menampilkan hasil akhir
					$codes=array_keys($densitas_baru);
					$sql="SELECT * FROM kerusakan WHERE kode_kerusakan IN('{$codes[0]}')";
					$result=$koneksi->query($sql);
					$row=$result->fetch_row();

					// lalu simpan kedalam database table pemilik
					$name = $_POST['name'];
					$no_hp = $_POST['no_hp'];
					$alamat = $_POST['alamat'];
					$tglkonsul = $_POST['tglkonsul'];

					$query = "INSERT INTO pemilik (nama_pemilik, no_hp, alamat, tgl_konsul, id_kerusakan, gejala, total_perhitungan) VALUES ('".$name."','".$no_hp."', '".$alamat."', '".$tglkonsul."', '".$row[0]."', '".serialize($pilihan_user)."', '".$densitas_baru[$codes[0]]."')";

					if($koneksi->query($query) === TRUE):
						// tangkap last id
						$last_id = $koneksi->insert_id;

						// hasil
						echo '<div class="alert alert-success">';
						echo '<h5><i class="icon fas fa-info"></i> Hasil Diagnosa!</h5>';
						echo "Terdeteksi Kerusakan <b>{$row[1]}</br> dengan derajat kepercayaan ".round($densitas_baru[$codes[0]],2)." <br> ";
						echo "<a href='proses_cetak.php?id=".$last_id."' class='btn btn-outline-dark'><i class='fa fa-print'></i> Cetak Laporan</a>";
						echo "<br>";
						echo "<br>";
						echo "<a href='index.php' class='btn btn-outline-dark'>Kembali</a>";
						echo '</div>';
					else:
						// print_r($koneksi->error_list);
					endif;	
				} 
			?>
		</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="assets/hasil-konsultasi/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/hasil-konsultasi/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/hasil-konsultasi/dist/js/adminlte.min.js"></script>
</body>

</html>
