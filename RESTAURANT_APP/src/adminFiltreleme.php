<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    $değer=$_GET['silindiMi'];
    header("Location: admin_musteriYonetim.php?değer=$değer");
    
}
?>