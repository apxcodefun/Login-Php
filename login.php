<?php
session_start();
require 'function.php';

// Cek cookies ready
if (isset($_COOKIE['id']) && $_COOKIE['key']){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil data berdasarkan id
    $result = mysqli_query ($conn, "SELECT username FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc ($result);

    // Cek cookies and username
    if ($key === hash('sha256',$row['username'])) {
        $_SESSION['login'] = true;
 
    }
}


if(isset($_SESSION['login'])){
    header("location:admin/index.php");
    exit;
}


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;

            // Cek Remember me 
            if(isset($_POST['remember'])) {
                setcookie('id', $row['id'], time()+ 600);
                setcookie('key', hash('sha256',$row['username'], time()+ 600));
            }
            header('location: admin/index.php');
        } 
    }

    $error = true;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1> Halaman Login</h1>
    <?php if(isset($error)):?>
        <div style="color: red; font-style:italic;">
            Username atau Password Salah
        </div>
    <?php endif;?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username"> Username :</label>
                <input type="text" name="username" for="username">
            </li>
            <li>
                <label for="password"> Password :</label>
                <input type="password" name="password" for="password">
            </li>
            <li>
                <input type="checkbox" name="remember" for="remember">
                <label for="remember">Remember me :</label>
            </li>
            <br><br>
            <button type="submit" name="login">Login!</button>
        </ul>
    </form>
</body>
</html>