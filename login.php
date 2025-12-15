<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main>
        <section class = "container">
            <header>
                <h1>Login</h1>
                <hr>
            </header>

            <article>
                <form action="proses_login.php" method="post">
                    <label for="">Username</label><br>
                    <input type="text" name="username" id="" required><br>

                    <label for="">Password</label><br>
                    <input type="password" name="password" id="" required><br>

                    <input type="submit" value="Login">

                    <div class="login-footer">
                        <p>Belum punya akun? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </article>
            
        </section>
    </main>
</body>
</html>