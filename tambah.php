<?php

include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM category");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah</title>
</head>
<body>
    <?php include 'navbar.php'?>

    <main>
        <section class = "container-mid">
            <header class = "form-title">
                <h1>Tambah To Do list</h1>
            </header>

            <article class = "form">
                <form action="proses_tambah.php">
                    <label for="">Title</label><br>
                    <input type="text" name="title" id=""><br>
                    
                    <label for="">Description</label><br>
                    <textarea name="description" id="" cols="30" rows="10"></textarea><br>

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
                    
                    <input type="submit" value="Tambah" class = "btn-success">
                    

                </form>
            </article>
        </section>
    </main>
</body>
</html>