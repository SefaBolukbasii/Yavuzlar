<?php
include "functions/functions.php";
if(isset($_POST["soruAdı"]) && isset($_POST["soru"]) &&isset($_POST["cevapA"]) && isset($_POST["cevapB"]) && isset($_POST["cevapC"]) && isset($_POST["cevapD"]) && isset($_POST["cevapDoğru"]) && isset($_POST["zorluk"]) && !empty($_POST["soruAdı"]) && !empty($_POST["soru"]) && !empty($_POST["cevapA"]) && !empty($_POST["cevapB"]) && !empty($_POST["cevapC"]) && !empty($_POST["cevapD"]) && !empty($_POST["cevapDoğru"]) && !empty($_POST["zorluk"])){
    $soruIsmi=$_POST["soruAdı"];
    $soru=$_POST["soru"];
    $Asecenegi=$_POST["cevapA"];
    $Bsecenegi=$_POST["cevapB"];
    $Csecenegi=$_POST["cevapC"];
    $Dsecenegi=$_POST["cevapD"];
    $dogruCevap=$_POST["cevapDoğru"];
    $zorluk=$_POST["zorluk"];
    soruEkle($soruIsmi,$soru,$Asecenegi,$Bsecenegi,$Csecenegi,$Dsecenegi,$dogruCevap,$zorluk);
    header("Location: yonetim.php");
}
else{
    header("Location: soruEkle.php?message=Tekrar Deneyiniz");
}
?>