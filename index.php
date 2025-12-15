<?php

session_start();
include 'koneksi.php';

if(!isset($_SESSION['username'])){
    header("location:login.php?login_dulu");
    exit;
}

$id_user = $_SESSION['id_user'];

if(isset($_GET['filter_category']) && $_GET['filter_category'] != ""){
    $id_category = $_GET['filter_category'];
    $sqlTodo = "SELECT t.*, c.category_name FROM todo t
                LEFT JOIN category c ON
                t.id_category = c.id_category
                WHERE t.id_user = '$id_user'
                AND t.id_category = '$id_category'
                ORDER BY t.id_todo DESC";
}else {
    $sqlTodo = "SELECT t.*, c.category_name FROM todo t
                LEFT JOIN category c ON
                t.id_category = c.id_category
                WHERE t.id_user = '$id_user'
                ORDER BY t.id_todo DESC";
}

if (isset($_POST['id_todo'])) {
    $id_todo = $_POST['id_todo'];

    $sql = "UPDATE todo
            SET status = IF(status='pending','done','pending')
            WHERE id_todo = '$id_todo'";

    mysqli_query($koneksi, $sql);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$queryTodo = mysqli_query($koneksi, $sqlTodo);

$sqlCategory = "SELECT * FROM category";
$queryCategory = mysqli_query($koneksi, $sqlCategory);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>To Do List</title>
</head>
<body>

    <header>
        <section class = "navbar">
            <ul>
                <div class="logo">
                    <li>
                        <a href="index.php"><img src="" alt="logo"></a>
                    </li>
                </div>

                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </section>
    </header>

    <main>
        <div class="hero-grid">
            <div class = "username">
                <p><?=$_SESSION['username']?></p>
            </div>
            <section class = "hero">
                <article class = "title">
                    <header class = "title">
                        <h1>To Do list App</h1>
                    </header>
                </article>

                <article class = "menu">
                    <div class="btn_tambah">
                        <a href="tambah.php">[+] Tambah</a>
                    </div>

                    <div class="filter-kategori">
                        <form method="GET">
                            <select name="filter_category" onchange="this.form.submit()"> <!-- ketika di klik, otomatis submit -->
                                <option value="">Semua</option>
                                <?php while($c = mysqli_fetch_assoc($queryCategory)) { ?>
                                    <option value="<?= $c['id_category']?>"
                                    <?= isset($_GET['filter_category']) && $_GET['filter_category'] == $c['id_category'] ? 'selected' : '' ?>>
                                    <?= $c['category_name']?>
                                </option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>

                    <div class="print">
                        <button class = "btn_print" onclick="window.print()">Print</button>
                    </div>
                </article>
            </section>
        </div>    

        <section class = "todolist">
            <div class="card-grid">
                <?php while($todo = mysqli_fetch_assoc($queryTodo)) {?>
                <article class = "card-todo <?= $todo['status'] == 'done' ? 'done' : '' ?>">
                    <form  method="POST">
                        <input type="hidden" name="id_todo" value="<?= $todo['id_todo'] ?>">
                        <input 
                            type="checkbox" 
                            onchange="this.form.submit()"
                            <?= $todo['status'] == 'done' ? 'checked' : '' ?>
                        >
                    </form>

                    <h5><strong><?= $todo['title'] ?></strong></h5>
                    <hr>
                    <small><?= $todo['description'] ?></small><br>
                    <p><strong>Status : </strong><?= $todo['status']?></p>
                    <p><strong>Category : </strong><?= $todo['category_name']?></p>
                            
                    <div class="card-footer">
                        <div class="btn-primary">
                            <a href="edit.php">Edit</a>
                        </div>
                        <div class="btn-danger">
                            <a href="hapus.php">Hapus</a>
                        </div>
                    </div>
                </article>
                <?php }?>
            </div>
        </section>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>