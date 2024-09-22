<?php
    session_start();
    include "functions/functions.php";
    if(!isset($_POST['username']) || !isset($_POST['password'])) {
        header("Location: login.php?message=Kullanıcı adı ve şifre boş bırakılamaz!");
        die();
    }
    else 
    {
        $kulAd = $_POST['username'];
        $password = $_POST['password'];
        $result = Login($kulAd);
        $hashsifre=$result['sifre'];
        if(!empty($result))
        {
            if(password_verify($password,$hashsifre)){
                $_SESSION["user_id"]=$result["id"];
                $_SESSION["role"]=$result["role"];
                $_SESSION["username"]=$result["username"];
                $_SESSION["balance"]=$result["balance"];
                $_SESSION["company_id"]=$result["company_id"];
                header("Location:index.php");
                exit();
            }
            else{
                header("Location:login.php?message=Kullanıcı Adı veya Şifre yanlış");
                exit();
            }
            
        }
        else
        {
            header("Location:login.php");
            exit();
        }
        die();
    }


?>