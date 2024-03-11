<?php
require '../function.php';

$id = $_GET['id'];

// Query Data
$pele = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if(isset($_POST['submit']) ) {
    
    if (ubah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah');
        window.location.href='index.php';
        </script>";

    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post">
    <ul>
        <input type="hidden" name="id" value="<?=$pele['id'];?>" />
        <li>
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" id="nrp" value="<?=$pele['nrp'];?>" required>
        </li>
        <li>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?=$pele['nama'];?>">
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?=$pele['email'];?>">
        </li>
        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" value="<?=$pele['jurusan'];?>">
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="text" name="gambar" id="gambar" value="<?=$pele['gambar'];?>">
        </li>
        <li>
            <button type="submit" name="submit">Update</button>
        </li>
    </ul>
    </form>

</body>
</html>