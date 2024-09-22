<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Admin"){
    include "functions/functions.php";
    $firmalar=FirmaGetir();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Yönetim</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detayFirma{
            display:none;
        }
        .detayYemekler{
            display:none;
        }
        .detayGuncelle{
            display:none;
        }
    </style>
</head>
<body>
<div class="containerMusteri">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="filtreleme">
            <form action="" method="post">
                <input type="text" placeholder="  Firma Adı" style="width:250px; height: 25px; font-size:20px; font-weight:bold; border-radius:10px;">
                <button type="submit">Ara</button>
            </form>
        </div>
        <?php foreach($firmalar as $firma) {?>
            <div class="musterilerContainer">
                <div class="musteriCon">
                    <p><?php echo $firma['name']?></p>
                    <div class="goruntuleSil" >
                        <button type="submit" onclick="AltDivGösterYemekler(this)" style="margin-right: 10px;">Yemekler</button>
                        <button type="submit" onclick="AltDivGösterGüncelle(this)">Güncelle</button>
                        <form action="firmaSil.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $firma['id'] ?>">
                            <button type="submit" name="silButon">Sil</button>
                        </form>
                    </div>
                    <div class="detayYemekler">
                        <?php
                            $restID=explode(",",$firma['restID']);
                            foreach($restID as $restA){
                                $yemekler=AdminYemekGetir($restA);
                                foreach($yemekler as $yemek){
                        ?>
                        <p><?php echo $yemek['name'];?></p>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="detayGuncelle">
                        <form action="firmaGüncelle.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $firma['id'] ?>">
                            <input type="text" name="name" value="<?php echo $firma['name']?>">
                            <textarea name="description" row="3"><?php echo $firma['description']?></textarea>
                            <button type="submit" class="butonTek">Güncelle</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <?php } ?>
        <button class="butonTek" onclick="AltDivGöster(this)">Firma Ekle</button>
        <div class="detayFirma">
            <form action="firmaEkle.php" method="post">
                <input type="text" name="isim" placeholder="Firma Adı">
                <input type="text" name="aciklama" placeholder="Hakkında Yazısı">
                <input type="text" name="username" placeholder="Kullanıcı Adı">
                <input type="text" name="sifre" placeholder="Sifre">
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
    function AltDivGösterYemekler(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling;
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="flex";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    function AltDivGösterGüncelle(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.nextElementSibling;
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