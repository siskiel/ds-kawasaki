<!-- halaman konsultasi -->
<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Isi Data Diri</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/reg/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <!-- Main css -->
    <link rel="stylesheet" href="assets/reg/css/style.css">
    <style>
        /*design table 1*/
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }
        
        .table1, th, td {
            padding: 8px 10px;
        }

        .table1, th {
            font-size: 15px;
        }
    </style>
</head>
<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <form method="POST" id="signup-form" class="signup-form" action="aksi-reg.php">
                    <h2>Konsultasi Info</h2>
                    <p class="desc">Silahkan isi data diri anda</span></p>
                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="no_hp" id="no_hp" placeholder="No. Hp"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-input" name="alamat" id="alamat" placeholder="Alamat"/>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input class="input--style-2 js-datepicker" type="date" placeholder="Tanggal Hari Ini" name="tglkonsul">
                            </div>
                    </div>
                    <div class="form-group">
                <label for="pilihan"> <span>* Silahkan pilih gejala sesuai dengan yang </span></label>
            </div>
                        <?php $ambil=$koneksi->query("SELECT * FROM gejala"); $no=1;?>
                        <table class="table1">
                            <?php while($pecah = $ambil->fetch_assoc()){?>
                                <tr>
                                    <th align="left"><?php echo $no ?></th>
                                    <th align="left"><?php echo $pecah['nama_gejala'];?></th>
                                    <td align="center">
                                        <div class="form-radio-item">
                                            <input type="radio" name="id_gejala[<?php echo $pecah['id_gejala'] ?>]" id="<?php echo 'ya' . $pecah['id_gejala'] ?>" value ="<?php echo $pecah['nilai_ds'];?>">
                                            <label for="<?php echo 'ya' . $pecah['id_gejala'] ?>">Ya</label>
                                            <span class="check"></span>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <div class="form-radio-item">
                                            <input type="radio" name="id_gejala[<?php echo $pecah['id_gejala'] ?>]" id="<?php echo 'tidak' . $pecah['id_gejala'] ?>" value="0">
                                            <label for="<?php echo 'tidak' . $pecah['id_gejala'] ?>">Tidak</label>
                                            <span class="check"></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php $no++;} ?>
                        </table>
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit submit" value="Submit"/>
                        <input type="reset" name="reset" id="reset" class="form-submit btn btn-outline-dark " value="Reset All"/>
                        <a href="index.php" class="btn btn-outline-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="assets/reg/vendor/jquery/jquery.min.js"></script>
    <script src="assets/reg/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>