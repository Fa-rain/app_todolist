<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("location:login.php?login_dulu!");
    exit;
}

$id_user = $_SESSION['id_user'];

/* ======================
   QUERY DASAR
====================== */
$sql = "
    SELECT t.*, c.category
    FROM todo t
    JOIN category c ON t.id_category = c.id_category
    WHERE t.id_user = '$id_user'
";

$conditions = [];

/* ======================
   FILTER CATEGORY
====================== */
if(!empty($_GET['filter-category'])){
    $conditions[] = "t.id_category = '{$_GET['filter-category']}'";
}

/* ======================
   FILTER STATUS
====================== */
if(!empty($_GET['filter-status'])){
    $conditions[] = "t.status = '{$_GET['filter-status']}'";
}

/* ======================
   FILTER FAVORITE
====================== */
if(isset($_GET['filter-bookmark'])){
    $conditions[] = "t.isFavorite = 1";
}

/* ======================
   GABUNGKAN KONDISI
====================== */
if(!empty($conditions)){
    $sql .= " AND " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY t.id_todo DESC";

$queryTodo = mysqli_query($koneksi, $sql);

/* ======================
   DATA LAIN
====================== */
$queryCategory = mysqli_query($koneksi, "SELECT * FROM category");

$queryTodo = mysqli_query($koneksi, $sql);

$queryStatus = mysqli_query($koneksi, "SELECT status FROM todo");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do list</title>
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
                        <select name="filter-category" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <?php while($c = mysqli_fetch_assoc($queryCategory)) { ?>
                                <option value="<?= $c['id_category']?>"
                                    <?= ($_GET['filter-category'] ?? '') == $c['id_category'] ? 'selected' : '' ?>>
                                    <?= $c['category']?>
                                </option>
                            <?php } ?>
                        </select>

                        <select name="filter-status" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="pending" <?= ($_GET['filter-status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="done" <?= ($_GET['filter-status'] ?? '') == 'done' ? 'selected' : '' ?>>Done</option>
                        </select>

                        <label>
                            <input type="checkbox" name="filter-bookmark" value="1"
                                <?= isset($_GET['filter-bookmark']) ? 'checked' : '' ?> onchange = "this.form.submit()">
                            Favorit
                        </label>
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