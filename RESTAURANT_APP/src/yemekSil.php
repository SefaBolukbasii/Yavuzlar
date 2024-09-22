
<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Firma"){
        include "functions/functions.php";
        $foodID=$_POST['foodID'];
        YemekSil($foodID);
        header("Location: firma_Menu.php?message=Yemek silindi");
    }
    else{
        header("Location: index.php");
    }
    
}
?>