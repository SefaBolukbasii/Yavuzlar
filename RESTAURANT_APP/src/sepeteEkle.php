<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != 'http://localhost/yemekListe.php') {
        header("Location: login.php"); 
        exit;
    }
    else{
        include "functions/functions.php";
        $user_id=$_SESSION["user_id"];
        $food_id=$_POST["yemekİd"];
        $not=$_POST["detay"];
        $adet=$_POST["adet"];
        SepeteEkle($user_id,$food_id,$not,$adet);
        header("Location: yemekListe.php");
        die();
    }
    
}


?>