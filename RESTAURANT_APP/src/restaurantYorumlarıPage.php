<?php
include "functions/functions.php";
$yorumlar=YorumGetir();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorumlar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerYListe">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <div class="yorumlar">
            <?php foreach($yorumlar as $yorum) {?>
                <div class="yorum">
                    <div class="ust">
                        <?php 
                            $rest_id=$yorum['restaurant_id'];
                            $ortPuan=RestOrtPuan($rest_id);
                        ?>
                        <p style="width: 300px; padding-left:15px;"><?php echo $yorum['name'];?> </p>
                        <p>Restaurant Puanı(<?php echo number_format($ortPuan['ortPuan'],1); ?>)</p>
                    </div>
                    <div class="alt">
                        <div class="baslikPuan">
                            <p style="width: 200px; padding-left:15px;"><?php echo $yorum['title'];?> </p>
                            <p> Kullanıcı Puanı: <?php echo $yorum['score'];?></p>
                        </div>
                        <div class="yorumKismi">
                            <p><?php echo $yorum['description']?></p>
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
</body>
</html>