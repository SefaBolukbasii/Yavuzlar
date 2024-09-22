<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Firma"){
        include "functions/functions.php";
        $comp_id=$_SESSION['company_id'];
        $isim=$_POST['isim'];
        $aciklama=$_POST['aciklama'];
        RestEkle($comp_id,$isim,$aciklama);
        header("Location: index.php?message=Restaurant Eklendi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>