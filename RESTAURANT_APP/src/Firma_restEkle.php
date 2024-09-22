<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Firma"){

    include "functions/functions.php";
    $firmaId=$_SESSION["company_id"];
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerRestEkle">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <form action="restEkleQuery.php" method="post">
            <input type="text" name="isim" placeholder="Restaurant İsim">
            <textarea name="aciklama" rows="3" placeholder="Restaurant Açıklaması"></textarea>
            <button type="submit" class="butonTek">Oluştur</button>
        </form>
        <a href="index.php" class="indexAtag">
            <div class="AnaSayfaBtn">
               Ana Sayfa
            </div>
        </a>
    </div>
</body>
</html>

<?php
}
}?>