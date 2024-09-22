<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $id=$_POST['id'];
        KuponSil($id);
        header("Location: admin_kuponYonetim.php?message=Kupon silindi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>