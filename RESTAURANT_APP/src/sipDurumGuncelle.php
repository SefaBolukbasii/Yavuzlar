<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Firma"){
        include "functions/functions.php";
        $yeniDurum=$_POST['sipDurum'];
        $sipID=$_POST['sipID'];
        SipDurumGuncelle($sipID,$yeniDurum);
        header("Location: firma_siparişYonetim.php?message=Sipariş durumu güncellendi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>