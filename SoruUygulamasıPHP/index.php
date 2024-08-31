<?php
session_start();

if(!isset($_SESSION["username"]) && empty($_SESSION["username"]))
{
  header("Location: login.php?message=giriş yapınız");
}
else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Soru Çöz</title>
  </head>
  <body>
    <div class="anaContainer">
      <?php if($_SESSION["rol"]=="admin"):?>
      <a href="yonetim.php">
        <div class="butonAnaMenu">Kontrol Paneli</div>
      </a>
      <?php endif?>
      <a href="soru.php">
        <div class="butonAnaMenu">Soruları Listele</div>
      </a>
      <a href="scoreboard.php">
        <div class="butonAnaMenu">Puan Tablosu</div>
      </a>
      <form action="logout.php" >
        <button class='logout'>Çıkış Yap</button>
      </form>
    </div>
  </body>
</html>
<?php }?>