<?php

session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("location:login.php?login_dulu!");
}

$id_todo = $_GET['id_todo'];
$title = $_GET['title'];
$description = $_GET['description'];
$status = $_GET['status'];
$id_category = $_GET['id_category'];

$query = mysqli_query($koneksi, "UPDATE todo SET
        title = '$title',
        description = '$description',
        status = '$status',
        id_category = '$id_category'
        WHERE id_todo = '$id_todo'");

if($query){
    header("location:index.php?sukses");
    exit;
}else{
    header("location:index.php?gagal");
    exit;
}



?>