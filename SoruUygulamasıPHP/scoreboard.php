<?php
    session_start();

    if(!isset($_SESSION["username"]) && empty($_SESSION["username"]))
    {
      header("Location: login.php?message=giriş yapınız");
    }
    else
    {
        include "functions/functions.php";
        $scoreBoard=scoreBoardGetir();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="scoreBoard">
        
        <table>
            <tr>
                <th>Kullanıcı Adı</th>
                <th>Puan</th>
            </tr>
            <?php foreach($scoreBoard as $i) {?>
            <tr>
                <td><?php echo $i["soruyuCozen"];?></td>
                <td><?php echo $i["doğruSayisi"]*10;?></td>
            </tr>
            <?php } ?>   
        </table>
    </div>
</body>
</html>
<?php } ?>