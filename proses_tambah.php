<?php
session_start();

include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'GET' ){
    $title = $_GET['title'];
    $description = $_GET['description'];
    $id_category = $_GET['id_category'];
    $id_user = $_SESSION['id_user'];

    $sql = "INSERT INTO todo(title, description, id_category, id_user, created_at) VALUES
            ('$title', '$description', '$id_category', '$id_user', NOW())";
    $query = mysqli_query($koneksi, $sql);

    if($query){
        header("location:index.php?berhasil");
        exit;
    }else {
        header("location:tambah.php?gagal");
        exit;
    }
}

?>