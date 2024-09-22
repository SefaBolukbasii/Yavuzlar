<?php
session_start();
if(!isset($_SESSION["username"])&& empty($_SESSION["username"])){
  header("Location: login.php");
}
else{
    if($_SESSION['role']=="Admin"){
        include "functions/functions.php";
        $kupon_name=$_POST['name'];
        $kuponTutar=$_POST['indirim'];
        $seçiliRest=$_POST['restaurant_select'];
        KuponEkle($seçiliRest,$kupon_name,$kuponTutar);
        header("Location: admin_kuponYonetim.php?message=Kupon oluşturuldu");
    }
    else{
        header("Location: index.php");
    }
    
}
?>