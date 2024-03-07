<?php
require '../function.php';
if(isset($_POST['submit']) ) {
    
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        window.location.href='index.php';
        </script>";

    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post">
    <ul>
        <li>
            <label for="nrp">NRP</label>
            <input type="text" name="nrp" id="nrp" required>
        </li>
        <li>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama">
        </li>
        <li>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </li>
        <li>
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan">
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="text" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="submit">Submit</button>
        </li>
    </ul>
    </form>

</body>
</html>