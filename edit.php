<?php

include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM category");

$id_todo = $_GET['id_todo'];

$queryTodo = mysqli_query($koneksi, "SELECT t.*, category FROM todo t JOIN category c ON t.id_category = c.id_category
WHERE id_todo = '$id_todo'");

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
                <form action="proses_edit.php">
                    <?php $t = mysqli_fetch_assoc($queryTodo) ?>

                    <input type="hidden" name="id_todo" value = "<?= $t['id_todo']?>">

                    <label for="">Title</label><br>
                    <input type="text" name="title" id="" value = "<?= $t['title']?>"><br>
                    
                    <label for="">Description</label><br>
                    <textarea name="description" id="" cols="30" rows="10">

                    <?= $t['description']?>

                    </textarea><br>

                    <label for="">Category</label><br>
                    <select name="id_category" id="">
                        <?php while($c = mysqli_fetch_assoc($query)) {?>
                            <option value="<?= $c['id_category']?>"><?= $c['category']?></option>
                        <?php } ?>
                    </select><br>

                    <label for="">Status</label><br>
                    <select name="status" id="">
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                    </select><br>
                    <br>

                    <input type="submit" value="Simpan" class = "btn-primary">
                   
                </form>
            </article>
        </section>
    </main>
</body>
</html>