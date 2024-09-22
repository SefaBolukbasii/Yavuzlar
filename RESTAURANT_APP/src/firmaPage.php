<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Firma"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerIndex" style="height:450px;" >
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <a href="firma_Menu.php" class="indexAtag">
            <div class="indexButon">
                Menü Yönetimi
            </div>
        </a>
        <a href="firma_siparişYonetim.php" class="indexAtag">
            <div class="indexButon">
                Sipariş Yönetimi
            </div>
        </a>
        <a href="Firma_restEkle.php" class="indexAtag">
            <div class="indexButon">
                Restaurant Ekle
            </div>
        </a>
    </div>  
</body>
</html>
<?php
}
}
?>