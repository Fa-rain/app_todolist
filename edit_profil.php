<?php
session_start();

include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit</title>
</head>
<body>
    <?php include 'navbar.php'?>

    <main>
        <section class = "container-mid">
            <header class = "form-title">
                <h1>Edit To Do List</h1>
            </header>

            <article class ="form">
                <form action="proses_edit_profil.php">
                    <?php $u = mysqli_fetch_assoc($query) ?>

                    <input type="hidden" name="id_user" value = "<?= $u['id_user']?>">

                    <label for="">Username</label><br>
                    <input type="text" name="username" id="" value = "<?= $u['username']?>"><br>
                    
                    <label for="">Password</label><br>
                    <input type= "password" name="password" value = "<?= $u['password']?>"><br>

                    <label for="">Name</label><br>
                    <input type= "text" name="name" value = "<?= $u['name']?>"><br>

                    <label for="">Email</label><br>
                    <input type= "email" name="email" value = "<?= $u['email']?>"><br>
                    
                    <br>

                    <input type="submit" value="Simpan" class = "btn-primary">
                   
                </form>
            </article>
        </section>
    </main>
</body>
</html>