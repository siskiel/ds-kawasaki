<?php
    include('assets/hasil-konsultasi/plugins/dompdf/autoload.inc.php');
    include('config/koneksi.php');
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Konsultasi Kerusakan</title>

    <style>
        .table {
            width: 100%; background-color: transparent; border-collapse: collapse; display: table;
        }

        .table tr th {
            background: #228B22;
            color: #fff;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <center>
        <h1>Laporan Konsultasi Kerusakan Pada Sepeda Motor
         Kawasaki Ninja 250 Double Cylinder Engine Fuel Injection</h1>

        <hr/><br/><br/><br/>

        <table class="table" border="1px">
            <tbody>
                <?php
                    $result = $koneksi->query("SELECT * FROM pemilik JOIN kerusakan ON pemilik.id_kerusakan = kerusakan.id_kerusakan WHERE id_pemilik='".$_GET['id']."'");
    
                    $no = 1;
                    while($row = mysqli_fetch_array($result)):
                        echo "<tr>";
                        echo "<th>Nama Lengkap</th>";
                        echo "<td>" . $row['nama_pemilik'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>No. Hp</th>";
                        echo "<td>" . $row['no_hp'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Alamat</th>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Tgl. Konsul</th>";
                        echo "<td>" . date ('d F Y', strtotime($row['tgl_konsul'])). "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Kerusakan</th>";
                        echo "<td>" . $row['kode_kerusakan'] . " <br> " . $row['nama_kerusakan'] . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<th>Derajat Kepercayaan</th>";
                        echo "<td>" . round($row['total_perhitungan'],2) . "</td>";
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
                        echo "<td>" . $row['solusi'] . "</td>";
                        echo "</tr>";
                        
                    endwhile;
    
                    mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </center>

    <br><br><br>

</body>
</html>

<?php
$html = ob_get_clean();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_deteksi_kerusakan.pdf');
?>