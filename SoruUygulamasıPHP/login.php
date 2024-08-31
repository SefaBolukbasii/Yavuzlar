<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="containerLogin">
        <form action="loginQuery.php" method="post">
            <input type="text" class="loginInput" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" class="loginInput" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>