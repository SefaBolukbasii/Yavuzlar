<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Firma"){
        include "functions/functions.php";
        $restID=$_POST['restlar'];
        $isim=$_POST['yemekIsim'];
        $aciklama=$_POST['aciklama'];
        $fiyat=$_POST['fiyat'];
        YemekEkle($restID,$isim,$aciklama,$fiyat);
        header("Location: firma_Menu.php?message=Yemek Eklendi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>