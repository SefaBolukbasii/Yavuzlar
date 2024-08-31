<?php
    if(isset($_POST["secenek"])){
        session_start();
        $username=$_SESSION["username"];
        include "functions/functions.php";
        $secim=$_POST["secenek"];
        $dogru=$_POST["cevap"];
        $soruIsmi=$_POST["soruIsmi"];
        if(strtoupper($secim)==strtoupper($dogru))
        {
            soruYaz($soruIsmi,$username,"Doğru");
        }
        else
        {
            soruYaz($soruIsmi,$username,"Yanlış");
        }
        header("Location: soru.php");
    }
    

?>