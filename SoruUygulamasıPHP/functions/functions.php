<?php

    function Login($username,$sifre){
        include "db.php";
        $query= "SELECT *,COUNT(*) as count from User Where username= :username and sifre= :sifre";
        $statement=$pdo->prepare($query);
        $statement->execute(['username' =>$username, 'sifre'=>$sifre]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function soruEkle($soruIsmi,$soru,$Asecenegi,$Bsecenegi,$Csecenegi,$Dsecenegi,$dogruCevap,$zorluk){
        include "db.php";
        $query="INSERT INTO soruTablo(soruIsmi,soru,Asecenegi,Bsecenegi,Csecenegi,Dsecenegi,dogruSecenek,zorluk) VALUES ('$soruIsmi','$soru','$Asecenegi','$Bsecenegi','$Csecenegi','$Dsecenegi','$dogruCevap','$zorluk')";
        $statement = $pdo->prepare($query);
        $statement-> execute();
        $pdo=null;

    }
    function soruDuzenle($soruIsmi,$soru,$Asecenegi,$Bsecenegi,$Csecenegi,$Dsecenegi,$dogruCevap,$zorluk,$degisecekSoru){
        include "db.php";
        $query="UPDATE soruTablo SET soruIsmi= :soruIsmi ,soru= :soru ,Asecenegi= :Asecenegi,Bsecenegi= :Bsecenegi,Csecenegi= :Csecenegi,Dsecenegi= :Dsecenegi,dogruSecenek= :dogruSecenek,zorluk= :zorluk WHERE soruIsmi= :degisIsim";
        $statement=$pdo->prepare($query);
        $statement->execute(['soruIsmi' =>$soruIsmi,'soru'=>$soru,'Asecenegi'=>$Asecenegi,'Bsecenegi'=>$Bsecenegi,'Csecenegi'=>$Csecenegi,'Dsecenegi'=>$Dsecenegi,'dogruSecenek'=>$dogruCevap,'zorluk'=>$zorluk,'degisIsim'=>$degisecekSoru]);
        $pdo=null;
    }
    function soruSil($soruIsmi){
        include "db.php";
        $query="DELETE FROM soruTablo where soruIsmi= :soruIsmi ";
        $statement=$pdo->prepare($query);
        $statement->execute(['soruIsmi' =>$soruIsmi]);
        $pdo=null;
    }
    function sorularıGetir(){
        include "db.php";
        $query="SELECT * FROM soruTablo";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function duzenlenecekSoruGetir($soruIsmi){
        include "db.php";
        $query="SELECT * FROM soruTablo WHERE soruIsmi= :soruIsmi";
        $statement=$pdo->prepare($query);
        $statement->execute(['soruIsmi' =>$soruIsmi]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;

    }
    function kullaniciCozSorular($username){
        include "db.php";
        $query="SELECT cozulenSoruIsim from cozulenSorular where soruyuCozen= :username";
        $statement=$pdo->prepare($query);
        $statement->execute(['username' => $username]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;

    }
    function UygunSoruGetir($username){
        $cozulenSorular=kullaniciCozSorular($username);
        $tumSorular=sorularıGetir();
        if(count($cozulenSorular)>0){
            if(count($cozulenSorular)==count($tumSorular))
            {
                return "Tüm Soruları Çözdünüz";
            }
            else
            {
                foreach($tumSorular as $soru)
                {
                    foreach($cozulenSorular as $coz)
                    {
                        if($soru['soruIsmi']!=$coz['cozulenSoruIsim'])
                        {
                            $kalanSorular[]=$soru;
                        }
                        
                    }
                }
                return $kalanSorular;
            }
        }
        else{
            return $tumSorular;
        }

    }
    function soruYaz($soruIsmi,$cozen,$sonuc){
        include "db.php";
        $query="INSERT INTO cozulenSorular(cozulenSoruIsim,soruyuCozen,sonuc) VALUES ('$soruIsmi','$cozen','$sonuc')";
        $statement = $pdo->prepare($query);
        $statement-> execute();
        $pdo=null;
    }
    function scoreBoardGetir(){
        include "db.php";
        $query="SELECT soruyuCozen,COUNT(*) as doğruSayisi from cozulenSorular WHERE sonuc='Doğru' GROUP BY soruyuCozen";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
?>