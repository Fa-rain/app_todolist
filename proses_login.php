<?php
session_start();
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($koneksi, $sql);

    $user = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query) == 1){
        $_SESSION['id_user'] = $user['id_user']; 
        $_SESSION['username'] = $user['username']; 
        $_SESSION['email'] = $user['email']; 

        header("location:index.php?berhasil_login");
        exit;
    }else{
        header("location:login.php?gagal_login");
        exit;
        alert("Login Gagal");
    }

}



?>