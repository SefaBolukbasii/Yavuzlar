<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != 'http://localhost/sepetPage.php') {
        header("Location: login.php"); 
        exit;
    }
    else{
        include "functions/functions.php";
        $toplamTutar=$_SESSION["toplamTutar"];
        $userID=$_SESSION["user_id"];
        $balance=$_SESSION["balance"];
        if($toplamTutar<=$balance){
            SiparişKaydet($userID,$toplamTutar);
            SepetTemzile($userID);
            UcretDus($userID,$toplamTutar);
            header("Location:index.php?message=Siparişiniz Alınmıştır");
        }
        else{
            header("Location:sepetPage.php?message=Yetersiz Bakiye");
        }
        
    }
    
}
?>