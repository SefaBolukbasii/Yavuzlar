<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
  if($_SESSION["role"]=="Admin"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerIndex" style="height:450px;" >
        <div class="logoIndex">
            <img src="logo.png" alt="Yavuzlar Logo" style="width: 250px; height: 100px;">
        </div>
        <a href="admin_musteriYonetim.php" class="indexAtag">
            <div class="indexButon">
                Müşteri Yönetimi
            </div>
        </a>
        <a href="admin_firmaYonetim.php" class="indexAtag">
            <div class="indexButon">
                Firma Yönetimi
            </div>
        </a>
        <a href="admin_kuponYonetim.php" class="indexAtag">
            <div class="indexButon">
                Kupon Yönetimi  
            </div>
        </a>
    </div>
</body>
</html>
<?php
}
}
?>