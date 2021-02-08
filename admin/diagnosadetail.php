<?php $ambil=$koneksi->query("SELECT * FROM pemilik WHERE pemilik.id_pemilik='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<h2 align="center">Detail pemilik Sepeda Motor Kawasaki Ninja 250 Double Cylinder Engine Fuel Injection</h2>
    <h3><?php echo $detail['nama_pemilik']; ?> </h3>
<div class="pull-right">
   <a href="index.php?halaman=diagnosa" class="btn-warning btn"> << Kembali </a>
</div>
<br>
<div class="form-row">
    <div class="form-group">
        <div class="col-md-6">
            <p>No. HP</p> 
            <input type="text" readonly value="<?php echo $detail['no_hp']; ?>" class="form-control"> 
        </div>
    </div>
</div> 
<div class="form-row">
    <div class="form-group">
        <div class="col-md-6">
            <p>Alamat</p> 
            <input type="text" readonly value="<?php echo $detail['alamat']; ?>" class="form-control"> 
        </div>
    </div>
</div> 
<div class="form-row">
    <div class="form-group">
        <div class="col-md-6">
            <p>Tanggal Konsul</p> 
            <input type="text" readonly value="<?php echo date ('d F Y', strtotime($detail['tgl_konsul'])); ?>" class="form-control"> 
        </div>
    </div>
</div> 
<div class="form-row">
    <div class="form-group">
        <div class="col-md-6">
            <p>Total Perhitungan</p> 
            <input type="text" readonly value="<?php echo round($detail['total_perhitungan']*100,2); ?>%" class="form-control"> 
        </div>
    </div>
</div> 
<div class="form-row">
    <div class="form-group">
        <div class="col-md-12">
            <h4><strong>Detail Gejala</strong></h4> 
            <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2">Penjelasan</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
                    $result = $koneksi->query("SELECT * FROM pemilik JOIN kerusakan ON pemilik.id_kerusakan = kerusakan.id_kerusakan WHERE id_pemilik='".$_GET['id']."'");
    
                    $no = 1;
                    while($row = mysqli_fetch_array($result)):
                        echo "<tr>";
                        echo "<th>Kerusakan</th>";
                        echo "<td>" . $row['kode_kerusakan'] . " <br> " . $row['nama_kerusakan'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>Gejala</th>";
                        echo "<td>";
                        $gejala = unserialize($row['gejala']);
                        foreach ($gejala as $key => $value) {
                            $result_gejala = $koneksi->query("SELECT * FROM gejala WHERE id_gejala='".$value."'");
                            while($row_gejala = mysqli_fetch_array($result_gejala)):
                                echo $key+1 . ". " . $row_gejala['nama_gejala'] . "<br>";
                            endwhile;
                        }
                        echo "</td>";
                        echo "</tr>";
                       
                        echo "<tr>";
                        echo "<th>Solusi</th>";
                        echo "<td>" . $row['solusi'] . " <br> </td>";
                        echo "</tr>";
                        
                        $no++;
                    endwhile;
    
                    mysqli_close($koneksi);
                ?>
        
    </tbody>
</table>
        </div>
    </div>
</div>
<!-- <div class="pull-right">
<a href="cetak.php&id=<?php echo $detail['id_pemilik'];?>" class="btn btn-primary" > <i class="fa fa-print">  Print</i> </a>
</div> -->

