<?php
try{
    $pdo=new PDO("sqlite:db/soruUygulamasıphp.db");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch(\Throwable $th){
    echo "hata " . $th;
}

?>