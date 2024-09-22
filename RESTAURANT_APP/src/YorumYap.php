<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    include "functions/functions.php";
    $user_id=$_SESSION["user_id"];
    $order_id=$_POST['sipId'];
    $rest_ID=$_POST['rest_id'];
    $username=$_SESSION["username"];
    $title=$_POST['baslik'];
    $yorum=$_POST['yorum'];
    $puan=$_POST['puan'];
    YorumYap($user_id,$order_id,$rest_ID,$username,$title,$yorum,$puan);
    header("Location: index.php?message=$username");
    
}

?>