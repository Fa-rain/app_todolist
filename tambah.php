<?php
session_start();
include 'koneksi.php';

$sqlCategory = "SELECT * FROM category";
$queryCategory = mysqli_query($koneksi, $sqlCategory);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah todolist</title>
</head>
<body>
    <main>
        <section class = "container">
            <header>
                <h1>Tambah ToDoList</h1>
            </header>

            <article class = "tambah">
                <form action="proses_tambah.php" method="GET">
                    <label for="">Title : </label><br>
                    <input type="text" name="title" id=""><br>

                    <label for="">Description :</label><br>
                    <textarea name="description" id=""></textarea><br>

                    <select name="id_category" id="">
                    <?php while($c = mysqli_fetch_assoc($queryCategory)) {?>
                        <option value="<?= $c['id_category']?>"><?= $c['category_name']?></option>
                    <?php } ?>
                    </select><br>

                    <input type="submit" value="Tambah">

                </form>
            </article>
        </section>
    </main>
</body>
</html>