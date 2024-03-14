<?php
session_start();
    if(!isset($_SESSION['login'])) {
        header("location:../login.php");
        exit;
    }
 require '../function.php';

//  pagination
    $jumlahdata = 2;
    $data = count(query("SELECT * FROM mahasiswa"));
    $jumlahhalaman = ceil($data / $jumlahdata);
    $halamanaktif= (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;

    $awaldata = ($jumlahdata * $halamanaktif) - $jumlahdata;

    $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata, $jumlahdata");


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
    <br><br>

    <!-- Navigation -->
    <?php if($halamanaktif - 1):?>
        <a href="?halaman=<?=$halamanaktif - 1;?>">&laquo;</a>
    <?php endif;?>


    <?php for($i = 1 ; $i <= $jumlahhalaman; $i++):?>
        <?php if($i == $halamanaktif):?>
        <a href="?halaman=<?=$i;?>" style="font-weight:bold;color:red;"><?=$i;?></a>
        <?php else:?>
            <a href="?halaman=<?=$i;?>"><?=$i;?></a>
            <?php endif;?>
    <?php endfor; ?>

    
    <?php if($halamanaktif < $jumlahhalaman):?>
        <a href="?halaman=<?=$halamanaktif + 1;?>">&raquo;</a>
    <?php endif;?>

    <br>

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