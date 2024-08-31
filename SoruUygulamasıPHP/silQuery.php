<?php
include "functions/functions.php";
if(isset($_POST["soruIsmi"])){
    $soruIsmi=$_POST["soruIsmi"];
    soruSil($soruIsmi);
    header("Location: yonetim.php");
}
else{
    header("Location:yonetim.php?message=silme işlemi sırasında hata oluştu");
}
?>