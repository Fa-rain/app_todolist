<?php

session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("location:login.php?login_dulu!");
}

$id_todo = $_GET['id_todo'];
$isFavorite = $_GET['isFavorite'];

$query = mysqli_query($koneksi, "UPDATE todo SET isFavorite = '$isFavorite' WHERE id_todo = '$id_todo'");

if($query){
    header("location:index.php?berhasil");
    exit;
}else{
    header("location:index.php?gagal");
    exit;
}

?>