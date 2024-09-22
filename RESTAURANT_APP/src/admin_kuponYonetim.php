<?php
    session_start();
    if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
      header("Location: login.php");
    }
    else{
      if($_SESSION["role"]=="Admin"){
        include "functions/functions.php";
        $kuponlar=KuponGetir();
        $restaurantlar=KuponRestGetir();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kupon Yönetimi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detayCupon{
            display:none;
        }
    </style>
</head>
<body>
    <div class="containerMusteri">
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <?php foreach($kuponlar as $kupon) {?>
            <div class="musterilerContainer">
                <div class="musteriCon">
                    <p style="width:250px;"><?php echo $kupon['name']," - ",$kupon['discount']?></p>
                    <div class="goruntuleSil" style="margin-left:100px; margin-right:5px;">
                        <form action="kuponSil.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $kupon['id'] ?>">
                            <button type="submit" name="silButon" style="width:75px; margin-bottom:10px;">Sil</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <button class="butonTek" onclick="AltDivGöster(this)">Kupon Ekle</button>
        <div class="detayCupon">
            <form action="kuponOlustur.php" method="post">
                <input type="text" name="name" placeholder="Kupon Adı">
                <input type="number" name="indirim" id="indirimInput" placeholder="İndirim Tutarı">
                <label for="restaurantlar">İndirim Uygulanacak Restaurant Seçin</label>
                <select name="restaurant_select" id="restaurantlar">
                    <option value="-1">Tüm Restaurantlar</option>
                <?php foreach($restaurantlar as $restaurant){ ?>
                    <option value="<?php echo $restaurant['id']; ?>"><?php echo $restaurant['name']; ?></option>
                <?php } ?>
                </select>
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
</script>
</body>
</html>
<?php
}
}
?>