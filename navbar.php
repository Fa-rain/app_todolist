<?php
include 'koneksi.php';

?>

<link rel="stylesheet" href="style.css">
<header>
    <nav>
        <ul>
            <div class="nav-left">
                <li><a href="index.php">Todolist</a></li>
            </div>
            
            <?php if(isset($_SESSION['id_user'])){
                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user' LIMIT 1");

                $user = mysqli_fetch_assoc($query);
                echo "
                <div class='nav-mid'>
                <li>Selamat Datang,
                    {$user['username']}!
                </li>
                </div>
                <div class='nav-right'>
                <li><a href='profil.php'>Profil</a></li>
                <li><a href='logout.php'>Logout</a></li>
                </div>
                ";
            }
            ?>
            
            
            
        </ul>
    </nav>
</header>