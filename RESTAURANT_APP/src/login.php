<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class=container>
        <div class="logo">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="giris">
            <form action="loginQuery.php" method="post">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required>
                <input type="password"  name="password" placeholder="Şifre" required>
                <button type="submit">Giriş Yap</button>
                <a class="kayıtOl" href="register.php">Kayıt Ol</a>
            </form>
            
        </div>
        
    </div>
</body>
</html>