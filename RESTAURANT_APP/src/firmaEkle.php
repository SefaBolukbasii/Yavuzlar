<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $isim=$_POST['isim'];
        $hakkinda=$_POST['aciklama'];
        $kulAd=$_POST['username'];
        $sifre=$_POST['sifre'];
        $hashedSifre=password_hash($sifre,PASSWORD_ARGON2ID);
        FirmaEkle($isim,$hakkinda,$kulAd,$hashedSifre);
        header("Location: admin_firmaYonetim.php?message=Firma başarı ile eklendi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>