<?php
$dsn="mysql:host=db;dbname=yavuzlarrestaurant;charset=utf8";
$username="php_docker";
$password="123";

try{
    $pdo=new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>