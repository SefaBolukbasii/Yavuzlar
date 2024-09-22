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
        $user_id=$_SESSION['user_id'];
        $name=$_POST['isim'];
        $surname=$_POST['soyisim'];
        $usernamee=$_POST['kulAd'];
        KulBilgiDegis($user_id,$name,$surname,$usernamee);
        header("Location: index.php?message=Bilgileriniz güncellenmiştir");
    }
    
}
?>