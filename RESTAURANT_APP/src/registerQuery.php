<?php
include "functions/functions.php";
if(!isset($_POST["isim"]) || !isset($_POST["soyisim"]) || !isset($_POST["kulAd"]) || !isset($_POST["sifre"]) ){
    header("Location:register.php?message=Zorunlu bilgileri doldurunuz");
    die();
}
else{
    $kulAd=$_POST["kulAd"];
    $kullanici=Login($kulAd);
    if(empty($kullanici)){
        $isim=$_POST["isim"];
        $soyisim=$_POST["soyisim"];
        $sifre=$_POST["sifre"];
        $hashedsifre=password_hash($sifre,PASSWORD_ARGON2ID);
        kulKaydet($isim,$soyisim,$kulAd,$hashedsifre);
        header("Location:login.php");
    }
    else{
        header("Location:register.php?mesage=bu kullanıcı adı zaten kullanımda");
        die();
    }
    
    
}

?>