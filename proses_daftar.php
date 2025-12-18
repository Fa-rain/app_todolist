<?php

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$birth_date = $_POST['birth_date'];

$query = mysqli_query($koneksi, "INSERT INTO user(username, password, email, birth_date)
                    VALUES
                    ('$username', '$password', '$email', '$birth_date')");

if($query){
    header("location:login.php?berhasil");
    exit;
}else{
    header("location:daftar.php?gagal");
    exit;
}

?>