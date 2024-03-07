<?php
    require '../function.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa (v1)</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="10">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Profile</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <tr>
            <?php $i =1;?>
            <?php foreach($mahasiswa as $mhs) :?>
            <td><?=$i?></td>
            <td>
                <a href="ubah.php">Update</a> |
                <a href="hapus.php?id=<?=$mhs['id'];?>">Hapus</a>
            </td>
            <td><img src="/php/gambar/<?=$mhs['gambar']; ?>" width="50"></td>
            <td><?=$mhs['nrp'];?></td>
            <td><?=$mhs['nama'];?></td>
            <td><?=$mhs['email'];?></td>
            <td><?=$mhs['jurusan'];?></td>
        </tr>
        <?php $i++;?>
        <?php endforeach;?>
        
    </table>

</body>
</html>