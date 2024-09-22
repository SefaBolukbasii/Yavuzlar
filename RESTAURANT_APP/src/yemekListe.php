<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    include "functions/functions.php";
    $yemekler=TumYemekleriGetir();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yemekler</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detay{
            display:none;
        }
    </style>
</head>
<body>
    <div class="containerYListe">
        <div class="logo">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="yemeklerListesi">
        <?php foreach($yemekler as $yemek) { ?>
            <div class="yemek">
                <div class="yemekUst">
                    <p><?php echo $yemek["name"]?></p>
                    <button class="detaylarButon" onclick="AltDivGöster(this)">Sipariş Ver</button>
                </div>
                <div class="detay" >
                    <form action="sepeteEkle.php" method="post">
                        <input type="hidden" name="yemekİd" value="<?php echo $yemek["id"]?>">
                        <textarea name="detay" rows="3"placeholder="Sipariş Notunuz"></textarea>
                        <input type="number" min="1" name="adet" value="1"require>
                        <button type="submit">Sepete Ekle</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        </div>
        <a href="index.php" class="indexAtag">
            <div class="AnaSayfaBtn">
               Ana Sayfa
            </div>
        </a>
    </div>
<script>
    
    function AltDivGöster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling;
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="block";
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
?>