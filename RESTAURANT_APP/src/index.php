<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  $rol=$_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerIndex" >
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <?php if($rol=="Admin"){ ?>
        <a href="adminPage.php" class="indexAtag">
            <div class="indexButon">
                Admin Sayfası
            </div>
        </a>
        <?php } ?>
        <?php if($rol=="Firma"){ ?>
        <a href="firmaPage.php" class="indexAtag">
            <div class="indexButon">
                Firma Sayfası
            </div>
        </a>
        <?php } ?>
        <?php if($rol=="Musteri"){ ?>
        <a href="musteriProfil.php" class="indexAtag">
            <div class="indexButon">
                Profil
            </div>
        </a>
        <?php } ?>
        <?php if($rol=="Musteri"){ ?>
        <a href="yemekListe.php" class="indexAtag">
            <div class="indexButon">
                Yemek Listesi   
            </div>
        </a>
        <a href="sepetPage.php" class="indexAtag">
            <div class="indexButon">
                Sepet
            </div>
        </a>
        <?php } ?>
        <a href="restaurantYorumlarıPage.php" class="indexAtag">
            <div class="indexButon">
                Restaurant Yorumları
            </div>
        </a>
        <?php if($rol=="Musteri"){ ?>
        <a href="gecmisSipPage.php" class="indexAtag">
            <div class="indexButon">
                Geçmiş Siparişler
            </div>
        </a>
        <?php } ?>
        <form action="logout.php" style="display:block; width:100%; ">
            <button class='logout'>Çıkış Yap</button>
        </form>
    </div>
    
</body>
</html>
<?php
}
?>