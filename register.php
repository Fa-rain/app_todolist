<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <main>
        <section class = "container">
            <header>
                <h1>Register</h1>
                <hr>
            </header>

            <article>
                <form action="proses_register.php" method="post">
                    <label for="">Username</label><br>
                    <input type="text" name="username" id=""><br>

                    <label for="">Email</label><br>
                    <input type="email" name="email" id=""><br>

                    <label for="">Password</label><br>
                    <input type="password" name="password" id=""><br>

                    <label for="">Birth Date</label><br>
                    <input type="date" name="birth_date" id=""><br>
                    <br>
                    <input type="submit" value="Register">

                    <div class="register-footer">
                        <p>Sudah punya akun? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </article>
            
        </section>
    </main>
</body>
</html>