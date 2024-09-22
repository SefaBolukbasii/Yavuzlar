<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Musteri"){

    include "functions/functions.php";
    $musId=$_SESSION["user_id"];
    $bilgiler=ProfilBilgileri($musId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .sifDegis{
            display:none;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="logo">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <p class="BakiyeP">Bakiye : <?php echo $bilgiler['balance']?></p>
        <div class="giris">
            <form action="userDuzenle.php" method="post">
                <input type="text" name="isim" placeholder="İsim" value="<?php echo $bilgiler['name']?>">
                <input type="text" name="soyisim" placeholder="Soyisim" value="<?php echo $bilgiler['surname']?>">
                <input type="text" name="kulAd" placeholder="Kullanıcı Adı" value="<?php echo $bilgiler['username']?>">
                <button type="submit" style="margin-left:37px;" class="butonTek">Güncelle</button>
            </form>
        </div>
        <button onclick="AltDivGöster(this)" class="butonTek">Şifre Değiştir</button>
        <div class="sifDegis" >
            <form action="userSifDegis.php" method="post">
                <input type="text" name="yeniSifre">
                <button type="submit">Onayla</button>
            </form>
        </div>
        <a href="index.php" class="indexAtag">
            <div class="AnaSayfaBtn">
               Ana Sayfa
            </div>
        </a>
</div>
<script>
    
    function AltDivGöster(dugme){
        var detayDiv=dugme.nextElementSibling;
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="flex";
        }
        else{
            detayDiv.style.display="none";
        }
    }
</script>
</body>
</html>
<?php
  }
}
?>