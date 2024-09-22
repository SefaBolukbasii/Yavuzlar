<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $mus_id=$_POST['userID'];
        KulSoftSil($mus_id);
        header("Location: admin_musteriYonetim.php?message=Kullanıcı başarı ile silindi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>