<h2> Data Kerusakan</h2>
<div class="pull-right">
<a href="index.php?halaman=kerusakantambah" class="btn-primary btn">Tambah Kerusakan</a>
</div>
<br>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Kerusakan</th>
            <th>Nama Kerusakan</th>
            <th>Solusi</th>
            <th>Aksi</th>

            
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1;?>
        <?php $ambil=$koneksi->query("SELECT * FROM kerusakan");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['kode_kerusakan'];?></td>
            <td><?php echo $pecah['nama_kerusakan'];?></td>
             <td><?php echo $pecah['solusi'];?></td>
            <td>
                <a href="index.php?halaman=kerusakanubah&id=<?php echo $pecah['id_kerusakan'];?>" i class="fa fa-clipboard fa-1x btn-primary btn">Edit</a>
                <a href="index.php?halaman=kerusakanhapus&id=<?php echo $pecah['id_kerusakan'];?>" i class="fa fa-times fa-1x btn-danger btn " onclick="return confirm('Apakah yakin ingin menghapus data kerusakan?');">Hapus</a>
            </td> 
        </tr>
        <?php $nomor++;?>
        <?php }?>
    </tbody>
</table>