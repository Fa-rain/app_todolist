<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>daftar</title>
</head>
<body>
    <main>
        <div>
            <section class="container-mid">
                <header class = "form-title">
                    <h1>Register</h1>
                </header>

                <article class = "form">
                    <form action="proses_daftar.php" method="POST">
                        <label for="">Username</label><br>
                        <input type="text" name="username" id=""><br>

                        <label for="">Password</label><br>
                        <input type="password" name="password" id=""><br>
                        
                        <label for="">Name</label><br>
                        <input type="text" name="name" id=""><br>

                        <label for="">Email</label><br>
                        <input type="email" name="email" id=""><br>

                        <label for="">Birth date</label><br>
                        <input type="date" name="birth_date" id=""><br>

                        <br>
                        <input type="submit" value="Register" class = "btn-success"><br>
                        <br>
                    </form>
                </article class = "form-footer">
                    <center><small>Sudah Punya Akun? <a href="login.php">Login</a></small></center>
                <article>

                </article>
            </section>
        </div>
        
    </main>
</body>
</html>