<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    include "functions/functions.php";
    $user_id=$_SESSION["user_id"];
    $geçmişSiparişler=GeçmişSiparişler($user_id);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <?php foreach ($geçmişSiparişler as $siparişG){ ?>
                <div class="yemek">
                    <div class="yemekUst">
                        <p><?php echo $siparişG["restAdi"]?> #<?php echo $siparişG["id"]?></p>
                        <button class="detaylarButon" onclick="AltDivGöster(this)">Detaylar</button>
                    </div>
                    <div class="detay">
                        <p><?php echo $siparişG["yemekAdi"]?></p>
                        <div class="yorum" style="width: 450px;">
                            <form action="YorumYap.php" method="post">
                                <input type="hidden" name="rest_id" value="<?php echo $siparişG['restaurant_id']; ?>">
                                <input type="hidden" name="sipId" value="<?php echo $siparişG['id']; ?>">
                                <input type="text" name="baslik" placeholder="Yorum Başlığı">
                                <textarea name="yorum" row="3"placeholder="Yorumunuz"></textarea>
                                <input type="range" name="puan" min="1" max="10" value=5 oninput="updateValue(this)" style="display:block;">
                                <div>Puan: <span id="puanKaydırma">5</span></div>
                                <button type="submit">Yorum Yap</button>
                            </form>
                        </div>
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
    
    function updateValue(cubuk){
        var span=cubuk.nextElementSibling.querySelector('span');
        span.textContent=cubuk.value;
    }
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