<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != 'http://localhost/musteriProfil.php') {
        header("Location: login.php"); 
        exit;
    }
    else{
        include "functions/functions.php";
        $yeniSifre=$_POST['yeniSifre'];
        $user_id=$_SESSION['user_id'];
        $hashedsifre=password_hash($yeniSifre,PASSWORD_ARGON2ID);
        SifreDegistir($user_id,$hashedsifre);
        header("Location: index.php?message=Şifreniz güncellendi");
    }
    
}
?>