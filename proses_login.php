<?php

session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password =$_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE
                        username = '$username' AND password = '$password'
                        LIMIT 1");
    
$user = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) == 1){
    $_SESSION['username'] = $user['username'];
    $_SESSION['id_user'] = $user['id_user'];

    header("location:index.php?login_berhasil!");
    exit;

}else{
    header("location:login.php?login_gagal!");
    exit;
}
    


?>