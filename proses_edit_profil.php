<?php

session_start();

if(!isset($_SESSION['id_user'])){
    header("location:login.php?login_dulu!");
}

include "koneksi.php";

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];

$query = mysqli_query($koneksi, "UPDATE user SET username = '$username',
            password = '$password',
            name = '$name',
            email = '$email'
            WHERE id_user = '$id_user'");

if($query){
    header("location:index.php?sukses");
    exit;
}else{
    header("location:index.php?gagal");
    exit;
}

?>