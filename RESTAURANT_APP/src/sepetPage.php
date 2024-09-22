<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    include "functions/functions.php";
    $user_id=$_SESSION["user_id"];
    $sepetUrunler=KullanıcıSepetiGetir($user_id);
    $toplamTutar=0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detay{
            display:none;
        }
    </style>
</head>
<body>
    <div class="containerYListe">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="urunler">
            <?php foreach($sepetUrunler as $sepetUrun){ ?>
                <?php
                    $yemekId=$sepetUrun["food_id"];
                    $yemekBilgileri=IdYemekGetir($yemekId);
                    $fiyat=$yemekBilgileri['price'];
                    $indirim=$yemekBilgileri['discount'];
                    $adet=$sepetUrun['quantity'];
                    $adetliFiyat=$adet*($fiyat-$indirim);
                    $toplamTutar=$toplamTutar+$adetliFiyat;
                ?>
                <div class="yemek">
                    <div class="yemekUst">
                        <p><?php echo $yemekBilgileri["name"];?></p>
                        <button class="detaylarButon" onclick="AltDivGöster(this)">Detaylar</button>
                    </div>
                    <div class="detay">
                        <p>Sipariş Notu: <?php echo $sepetUrun['note']; ?></p>
                        <p>Adet: <?php echo $sepetUrun['quantity']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php $_SESSION["toplamTutar"]=$toplamTutar;?>
        <p class="SepetTutar" >Toplam Tutar: <?php echo $toplamTutar;?></p>
        <a href="siparişVer.php" class="indexAtag" style="margin-bottom: 10px;">
            <div class="indexButon" style="width:150px; height:20px;padding: 0px 0px 10px 5px ">
                Sepeti Onayla
            </div>
        </a>
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
<?php } ?>