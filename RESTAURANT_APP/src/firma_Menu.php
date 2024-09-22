<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Firma"){

    include "functions/functions.php";
    $firmaId=$_SESSION["company_id"];
    $yemekler=YemekGetir($firmaId);
    $restaurantlar=FirmaRestGetir($firmaId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .yemekEkleDiv{
            display:none;
        }
        .yemekDuzenle{
            display: none;
        }
    </style>
</head>
<body>
    <div class="containerMusteri">
        <div class="filtreleme">
            <form action="" method="post">
                <input type="text" placeholder="  Yemek Adı" style="width:250px; height: 25px; font-size:20px; font-weight:bold; border-radius:10px;">
                <button type="submit">Ara</button>
            </form>
        </div>
        <?php foreach($yemekler as $yemek) {?>
            <div class="musterilerContainer">
                <div class="musteriCon">
                    <p ><?php echo $yemek['name']?></p>
                    <div class="goruntuleSil" style="margin-left:50px;">
                        <button class="butonTek" onclick="AltDivGösterDuzenle(this)">Görüntüle</button>
                        <form action="yemekSil.php" method="post">
                            <input type="hidden" name="foodID" value="<?php echo $yemek['id']; ?>">
                            <button type="submit" name="silButon">Sil</button>
                        </form>
                    </div>
                    <div class="yemekDuzenle">
                        <form action="" method="post">
                            <input type="text" name="yemekIsim" placeholder="Yemek İsmi" value="<?php echo $yemek['name']; ?>">
                            <textarea name="aciklama" rows="3" placeholder="Açıklama" ><?php echo $yemek['description']; ?></textarea>
                            <input type="number" name="fiyat" placeholder="Fiyat" value="<?php echo $yemek['price']; ?>">
                            <button type="submit" class="butonTek">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <button class="butonTek" onclick="AltDivGöster(this)">Yemek Ekle</button>
        <div class="yemekEkleDiv">
            <form action="yemekEkle.php" method="post">
                <select name="restlar">
                    <?php foreach($restaurantlar as $rest){?>
                        <option value="<?php echo $rest['id']?>"><?php echo $rest['name']?></option>
                    <?php } ?>
                </select>
                <input type="text" name="yemekIsim"placeholder="Yemek İsmi">
                <textarea name="aciklama" rows="3" placeholder="Yemek Açıklaması"></textarea>
                <input type="number" name="fiyat" placeholder="Fiyat">
                <button type="submit" class="butonTek">Oluştur</button>
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
    function AltDivGösterDuzenle(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling;
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
}?>



                        