<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $comp_id=$_POST['id'];
        $name=$_POST['name'];
        $aciklama=$_POST['description'];
        FirmaGuncelle($name,$aciklama,$comp_id);
        header("Location: admin_firmaYonetim.php?message=Firma başarı ile güncellendi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>