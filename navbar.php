<?php

?>

<link rel="stylesheet" href="style.css">
<header>
    <nav>
        <ul>
            <div class="nav-left">
                <li><a href="index.php">Todolist</a></li>
            </div>
            <?php if(isset($_SESSION['id_user'])){
                echo "
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