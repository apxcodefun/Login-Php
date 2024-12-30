<?php 

$conn = mysqli_connect('localhost','root','mysql','phplogin');




function query($query) {
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah ($data){
    global $conn;
    $nrp = htmlspecialchars($data['nrp']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    
    // Upload Gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO mahasiswa (nrp,nama,email,jurusan,gambar) VALUES ('$nrp','$nama','$email','$jurusan','$gambar')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp = $_FILES['gambar']['tmp_name'];

    //cek gambar
    if($error === 4) {
        echo "<script>
            alert('Pilih Gambar Dlu Mas Bro');
        </script>";
        return false;
    }

    // cek file gambar 
    $ekstensiGambar = ['jpg', 'png', 'jpeg'];
    $exgambar = explode('.',$namaFile);
    $exgambar = strtolower(end($exgambar));
    if(!in_array($exgambar,$ekstensiGambar) ){
        echo "<script>
            alert('Format Gambar Salah');
        </script>";
        return false;
    }

    if($ukuranFile > 10000000) {
        echo "<script>
            alert('Ukuran Gambar Terlalu Besar');
        </script>";
        return false;
    }

    // lolos pengecekan
    // generate random nama
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $exgambar; 

    move_uploaded_file($tmp,'../gambar/'. $namaFileBaru);
    return $namaFileBaru;
}

function hapus ($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}


function ubah ($data){
    global $conn;

    $id = $data['id'];
    $nrp = htmlspecialchars($data['nrp']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = $data["gambarLama"];

    //Cek user new image
    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $query ="UPDATE mahasiswa SET nrp = '$nrp', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'
              OR nrp LIKE '%$keyword%'
            OR email LIKE '%$keyword%'
            OR jurusan LIKE '%$keyword%'";

    return query($query);
}

function daftar($data) {
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn,$data['password']);
    $password2 = mysqli_real_escape_string($conn,$data['password2']);

    // cek username 
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    if($row) {
        echo "<script>
            alert('Username Sudah Terdaftar');
        </script>";
        return false;
    }

    // cek konfirm password
    if($password!= $password2) {
        echo "<script>
            alert('Konfirmasi Password Salah');
        </script>";
        return false;
    }

    // encrypt password
    $password = password_hash($password,PASSWORD_DEFAULT);

    // insert to database
    $query = "INSERT INTO user (username,password) VALUES ('$username','$password')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}
