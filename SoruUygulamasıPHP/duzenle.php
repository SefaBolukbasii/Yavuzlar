<?php
  session_start();
  if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
    header("Location: login.php");
  }
  else{
    if($_SESSION["rol"]=="admin"){
      if(isset($_POST["soruIsmi"]))
      {
        $degisecekSoru=$_POST["soruIsmi"];
        include "functions/functions.php";
        $soru=duzenlenecekSoruGetir($degisecekSoru);
        //header("Location:index.php?message=$degisecekSoru");
      }
      else{
        header("Location:index.php?message=duzenleme gelmedi");
      }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <script src="projeJava.js"></script>
  </head>
  <body >
    <div class="düzCon">
      <form action="duzenleQuery.php" method="POST">
        <input type="hidden" name="degisecekSoru" value=<?php echo $degisecekSoru?>>
        <input type="text" id="input1" name="soruAdı" value="<?php echo $soru['soruIsmi'];?>" />
        <input type="text" id="input2" name="soru" value="<?php echo $soru['soru'];?>" />
        <input type="text" id="input3" name="cevapA" value="<?php echo $soru['Asecenegi'];?>" />
        <input type="text" id="input4" name="cevapB" value="<?php echo $soru['Bsecenegi'];?>" />
        <input type="text" id="input5" name="cevapC" value="<?php echo $soru['Csecenegi'];?>" />
        <input type="text" id="input6" name="cevapD" value="<?php echo $soru['Dsecenegi'];?>" />
        <input type="text" id="input7" name="cevapDoğru" value="<?php echo $soru['dogruSecenek'];?>" />
        <input type="text" id="input8" name="zorluk" value="<?php echo $soru['zorluk'];?>" />
        <button type="submit">Kaydet</button>
      </form>
      
    </div>
  </body>
</html>
<?php 
  } 
  else
  {
    header("Location: index.php");
  }
  }
?>