<?php

session_start();
include 'koneksi.php';


$id_todo = $_GET['id_todo'];

$query = mysqli_query($koneksi, "DELETE FROM todo WHERE id_todo = '$id_todo'");

if($query){
    header("location:index.php?sukses");
    exit;
}else{
    header("location:index.php?gagal");
}

?>