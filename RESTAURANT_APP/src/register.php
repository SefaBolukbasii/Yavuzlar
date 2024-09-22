<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Kayıt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="giris">
            <form action="registerQuery.php" method="post">
                <input type="text" name="isim" placeholder="İsim">
                <input type="text" name="soyisim" placeholder="Soyisim">
                <input type="text" name="kulAd" placeholder="Kullanıcı Adı">
                <input type="password" name="sifre" placeholder="Şifre">
                <button type="submit" style="margin-left:70px;">Kayıt Ol</button>
            </form>
        </div>
    </div>
</body>
</html>