<?php
require 'function.php';

if(isset($_POST['register'])){

    if(daftar($_POST) > 0){
        echo "<script>alert('Registrasi berhasil');</script>";
        echo "<script>window.location='login.php';</script>";
    }else{
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Halaman Regitrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Masukkan Ulang Kata Sandi Anda :</label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>
</html>