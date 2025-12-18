<?php
session_start();

include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user' LIMIT 1");

$user = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <main>
        <section class = "container-user">
            <header class ="form-title">
                <h1>Profil saya</h1>
            </header>
            <hr>
            <br>    
            <article>
                <p><b>Username : </b><?= $user['username']?></p>
                <p><b>password : </b>********</p>
                <p><b>Name : </b><?= $user['name']?></p>
                <p><b>Email : </b><?= $user['email']?></p><br>

                <div class="profil-footer">
                    <div class="btn-primary">
                        <a href="edit_profil.php?<?= $user['id_user']?>">Edit Profil</a>
                    </div>
                </div>

            </article>

        </section>
    </main>
</body>
</html>