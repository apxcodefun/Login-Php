<?php
session_start();
    if(!isset($_SESSION['login'])) {
        header("location:../login.php");
        exit;
    }
    require '../function.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");


    if(isset($_POST['cari'])){
        $mahasiswa = cari($_POST['keyword']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>

    <a href="../logout.php">Logout</a>
    <h1>Daftar Mahasiswa (v1)</h1>
    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>
    <form action="" method="post">
        <input type="text" name="keyword" size="50" autofocus placeholder="Masukkan Data Yang Anda Inginkan!" autocomplete="off">
        <button type="submit" name="cari">Cari Data</button>
        <br><br>
    </form>
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
                <a href="ubah.php?id=<?=$mhs['id'];?>">Update</a> |
                <a href="hapus.php?id=<?=$mhs['id'];?>" onclick="return confirm('yakin?');">Hapus</a>
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