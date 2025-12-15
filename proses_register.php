<?php

include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['password'];
    $password = $_POST['password'];
    $birth_date = $_POST['birth_date'];

    $sql = "INSERT INTO users(username, password, email, birth_date) VALUES
            ('$username','$email','$password','$birth_date')";
    
    $query = mysqli_query($koneksi, $sql);

    if($query){
        header("location:login.php?berhasil register");
        exit;
    }else{
        header("location:register.php?gagal register");
        exit;
        alert("Register Gagal");
    }
}



?>