<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["rol"]=="admin"){
      include "functions/functions.php";
      $sorular=sorularıGetir();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="anaContainerYonetim">
      <input type="text" id="soruAra" placeholder="Soru Ara" />
      <div id="container">
        <?php
          foreach($sorular as $soru){
        ?>
          <div class="yonetimSorular">
            <div>
              <p><?php echo $soru["soruIsmi"]; ?></p>
            </div>
            <div class="linklerSınıf">
              <form action="duzenle.php" method="POST">
                  <input type="hidden" name="soruIsmi" value="<?php echo $soru["soruIsmi"]; ?>">
                  <button type="submit" name="soruDuzenle">Düzenle</button>
              </form>
              <form action="silQuery.php" method="POST">
                  <input type="hidden" name="soruIsmi" value="<?php echo $soru["soruIsmi"]; ?>">
                  <button type="submit" name="soruSil">Sil</button>
              </form>
            </div>
          </div>
        <?php } ?>

      </div>
      <form action="soruEkle.php">
        <button class="soruEkleButonu" type="submit">Soru Ekle</button>
      </form>
    </div>
  </body>
</html>
<?php
}
else{
  header("Location: index.php?message=Yonetim Paneline erişim yetkiniz yok");
}
}
?>