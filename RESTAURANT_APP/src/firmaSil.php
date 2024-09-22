<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $comp_id=$_POST['id'];
        FirmaSil($comp_id);
        header("Location: admin_firmaYonetim.php?message=Firma başarı ile silindi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>