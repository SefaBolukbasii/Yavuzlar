<?php
  session_start();
  if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
    header("Location: login.php");
  }
  else{
    include "functions/functions.php";
    $sorular=UygunSoruGetir($_SESSION["username"]);
    if(is_array($sorular)){

    
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
    <div class="anaContainer">
      <div id="soruContainer"></div>
      <div>
        <div class="soruDiv">
          <div class="soruParagraf">
            <p><?php echo $sorular[0]['soru']?></p>
          </div>
          <div class="secenekler">
            <form action="sorukontrol.php" method="POST">
              <input type="hidden" name="soruIsmi" value="<?php echo $sorular[0]['soruIsmi']?>">
              <input type="hidden" name="cevap" value="<?php echo $sorular[0]['dogruSecenek']?>">
              <div class="secenek"><input type="radio" id="a" name="secenek" value="A"><label for="a"><?php echo $sorular[0]['Asecenegi']?></label></div>
              <div class="secenek"><input type="radio" id="b" name="secenek" value="B"><label for="b"><?php echo $sorular[0]['Bsecenegi']?></label></div>
              <div class="secenek"><input type="radio" id="c" name="secenek" value="C"><label for="c"><?php echo $sorular[0]['Csecenegi']?></label></div>
              <div class="secenek"><input type="radio" id="d" name="secenek" value="D"><label for="d"><?php echo $sorular[0]['Dsecenegi']?></label></div>
              <button type="sumit" >Kontrol Et</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
    }
    else
    {
      header("Location: index.php?message=Çözmediğiniz Soru Kalmadı");
    }  
}

?>