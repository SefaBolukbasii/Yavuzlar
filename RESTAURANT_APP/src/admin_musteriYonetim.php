<?php

session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Admin"){
    include "functions/functions.php";
    $silindiMiDeger=isset($_GET["değer"]) ? $_GET["değer"] : 0;
    if($silindiMiDeger==1 || $silindiMiDeger==0 ){
        $musteriler=MusteriGetir($silindiMiDeger);
    }
    else{
        header("Location:adminPage.php?message=geçerli bir parametre girin");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Yönetim</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detayMusteri{
            display:none;
        }
    </style>
</head>
<body>
    <div class="containerMusteri">
        <div class="filtreleme">
            <form action="adminFiltreleme.php" method="get">
                <input type="text" placeholder="  Username" style="width:250px; height: 25px; font-size:20px; font-weight:bold; border-radius:10px;">
                <button type="submit">Ara</button>
                <div class="secenekler">
                    <input type="radio" id="silinmemiş" name="silindiMi" value=0><label for="silinmemiş">Silinmeyen Kullanıcılar</label>
                    <input type="radio" id="silinmiş" name="silindiMi" value=1><label for="silinmiş">Silinen Kullanıcılar</label>
                </div>
                
            </form>
        </div>
        <?php foreach($musteriler as $musteri) {?>
            <div class="musterilerContainer">
                <div class="musteriCon" style="flex-direction: column;">
                    <div class="musteriCon">
                        <p><?php echo $musteri["username"]?></p>
                        <div class="goruntuleSil">
                            <button type="submit" name="goruntuleButon" onclick="AltDivGöster(this)">Görüntüle</button>
                            <form action="musteriSil.php" method="post">
                                <input type="hidden" name="userID" value="<?php echo $musteri["id"] ?>">
                                <button type="submit" name="yasaklaButon">Yasakla</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        $mus_id=$musteri['id'];
                        $siparisler=AdminKulSip($mus_id);
                    ?>
                    <div class="detayMusteri">
                        <p>İsim: <?php echo $musteri['name']; ?></p>
                        <p>Soyisim: <?php echo $musteri['surname']; ?></p>
                        <p>Bakiye: <?php echo $musteri['balance']; ?></p>
                        <table>
                            <caption>Kullanıcı Aktif Siparişleri</caption>
                            <tr>
                                <th>Sipariş ID</th>
                                <th>Sipariş Durumu</th>
                                <th>Toplam Fiyat</th>
                            </tr>
                        <?php foreach($siparisler as $siparis){ ?>
                            <tr>
                                <th><?php echo $siparis['id'];?></th>
                                <th><?php echo $siparis['order_status'];?></th>
                                <th><?php echo $siparis['total_price'];?></th>
                            </tr>
                        <?php } ?>
                        </table>
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
}
?>