<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("location:login.php?login_dulu!");
}

$id_user = $_SESSION['id_user'];

if(isset($_GET['filter-category']) && isset($_GET['filter-status'])){ // ada inputan dari filter category & status

    $id_category = $_GET['filter-category'];
    $status = $_GET['filter-status'];

    if(isset($_GET['filter-bookmark'])){ # ---> kalau ada inputan dari filter bookmark
        $isFavorite = $_GET['filter-bookmark'];
    }else { # ---> jika tidak,
        $isFavorite = 0;
    }

 

    if($id_category != '' && $status != ''){ # --->  dipilih, makeduanyaka menampilkan spesifik
        $sql = "SELECT t.*, category FROM todo t JOIN category c ON
        t.id_category = c.id_category  WHERE id_user = '$id_user' AND t.id_category = '$id_category' AND status = '$status' AND isFavorite = '$isFavorite'";
        
    }elseif ($id_category == '' && $status != ''){ # --> category tidak dipilih maka output tidak memandang category
        $sql = "SELECT t.*, category FROM todo t JOIN category c ON
        t.id_category = c.id_category WHERE t.id_user = '$id_user' AND status = '$status' AND isFavorite = '$isFavorite'";

    }elseif ($status == '' && $id_category != '') { # --> status tidak dipilih maka output tidak memandang status
        $sql = "SELECT t.*, category FROM todo t JOIN category c ON
        t.id_category = c.id_category WHERE t.id_user = '$id_user' AND t.id_category = '$id_category' AND isFavorite = '$isFavorite'";


    }elseif ($id_category == '' && $status == '') { # --> kedua tidak dipilih, maka output menampilkan semuanya
        $sql = "SELECT t.*, category FROM todo t JOIN category c ON
        t.id_category = c.id_category WHERE t.id_user = '$id_user' AND isFavorite = '$isFavorite'";

    }else {
        $sql = "SELECT t.*, category FROM todo t JOIN category c ON
        t.id_category = c.id_category WHERE id_user = '$id_user'";  
    }
    
}else{
    $sql = "SELECT t.*, category FROM todo t JOIN category c ON
    t.id_category = c.id_category WHERE id_user = '$id_user'";
}


$queryTodo = mysqli_query($koneksi, $sql);

$queryCategory = mysqli_query($koneksi, "SELECT * FROM category");
$queryStatus = mysqli_query($koneksi, "SELECT status FROM todo");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <main>
        <section class = "hero">
            <article>
                <!-- <div class="btn-success">
                    <button onclick = "window.print()">Print</button>
                </div> -->

                <div class="filter">
                    
                    <form method="get">
                        <select name="filter-category">
                            <option value="">Semua</option>
                        <?php while($c = mysqli_fetch_assoc($queryCategory)) { ?>
                            <option value="<?= $c['id_category']?>">
                            <?= $c['category']?>
                            </option>
                        <?php } ?>
                        </select>
                        <select name="filter-status">
                            <option value="">Semua</option>
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                        </select>
                        <label for="">Favorit</label>
                        <input type="checkbox" name="filter-bookmark" value= "1">
                        <input type="submit" value="filter" class = "btn-primary">
                    </form>
                </div>

                <center>
                <div class="btn-success">
                    <a href="tambah.php">[+] Tambah</a>
                </div>
                </center>
            </article>
        </section>

        <section class = "todo">
            <div class="card-grid">
                <?php while($t = mysqli_fetch_assoc($queryTodo)){ ?>
                <article class = "card-<?= $t['status']?>">
                    <div class="card-title">
                        <h3><?= $t['title'] ?></h3>
                        
                    </div>
                    
                    <hr>
                    <div class="card-desc">
                        <small><?= $t['description']?></small><br>
                    </div>
                   
                    <div class="card-p">
                        <p><strong>Category: </strong><?= $t['category']?></p>
                        <p><strong>Status: </strong><?= $t['status']?></p><br>
                    </div>
                    
                    <div class="card-footer">
                        <div class="btn-primary">
                            <a href="edit.php?id_todo=<?= $t['id_todo']?>">Edit</a>
                        </div>

                        <div class="btn-danger">
                            <a href="hapus.php?id_todo=<?= $t['id_todo']?>">Hapus</a>
                        </div>

                        <?php if ($t['isFavorite'] == 0){ ?>
                            <div class="btn-favorite">
                                <a href="tambah_favorit.php?id_todo=<?= $t['id_todo']?>&isFavorite=1">🤍</a>
                            </div>
                        <?php }else{?>
                            <div class="btn-favorite">
                                <a href="tambah_favorit.php?id_todo=<?= $t['id_todo']?>&isFavorite=0">💝</a>
                            </div>
                        <?php } ?>
                        
                    </div>
                    
                </article>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>