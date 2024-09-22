<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Firma"){
    include "functions/functions.php";
    $comID=$_SESSION["company_id"];
    $siparişler=FirmaSiparişleriGetir($comID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Yönetim</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .Sipicerik{
            display:none;
        }
    </style>
</head>
<body>
    <div class="containerMusteri">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <?php foreach($siparişler as $sipariş) {?>
            <div class="musterilerContainer">
                <div class="musteriCon">
                    <p >Sipariş ID #<?php echo $sipariş["id"]?></p>
                    <div class="goruntuleSil" style="margin-left:20px;">
                        <button class="butonTek" onclick="AltDivGöster(this)" style="width:230px;">Sipariş Görüntüle</button>
                    </div>
                </div>
                <?php
                    $sipBilgileri=SipDetayGetir($sipariş["id"]);
                ?>
                <div class="Sipicerik">
                    <?php foreach($sipBilgileri as $sipBilgi){?>
                        <div class="sipIcerikYemek">
                            <p><?php echo $sipBilgi['name']; ?></p>
                            <p>Sipariş Adeti: <?php echo $sipBilgi['quantity']; ?></p>
                        </div>
                    <?php } ?>
                    <div class="sipGenelBilgiler">
                        <p>Oluşturulma Tarihi: <?php echo $sipBilgileri[0]['created_at']; ?></p>
                        <p>Toplam Tutar: <?php echo $sipBilgileri[0]['total_price']; ?></p>
                        <p>Sipariş Durumu: <?php echo $sipBilgileri[0]['order_status']; ?></p>
                        <form action="sipDurumGuncelle.php" method="post">
                            <input type="hidden" name="sipID" value="<?php echo $sipariş["id"]; ?>">    
                            <select name="sipDurum" id="sipDurum">
                                <option value="" disable>Sipariş Durumunu Seçiniz</option>
                                <option value="Hazırlanıyor">Hazırlanıyor</option>
                                <option value="Yolda">Yolda</option>
                                <option value="Teslim Edildi">Teslim Edildi</option>
                            </select>
                            <button type="submit" class="butonTek" style="width:120px ">Onayla</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
        <a href="index.php" class="indexAtag">
            <div class="AnaSayfaBtn">
               Ana Sayfa
            </div>
        </a>
    </div>
<script>
    function AltDivGöster(dugme){
        var detayDiv=dugme.parentElement.parentElement.nextElementSibling;
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