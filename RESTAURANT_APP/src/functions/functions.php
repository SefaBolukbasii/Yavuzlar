<?php
    
    function MusteriGetir($silindiMi){
        include "db.php";
        $query="SELECT id,name,surname,username,balance,created_at from users where role='Musteri' and deleted_at=:silindiMi";
        $statement=$pdo->prepare($query);
        $statement->execute(['silindiMi' => $silindiMi]);
        $result=$statement-> fetchAll();
        $pdo=null;
        return $result;
    }
    function FirmaGetir(){
        include "db.php";
        $query="SELECT company.name,company.id,company.description,GROUP_CONCAT(restaurant.id) as restID from company INNER JOIN restaurant ON company.id=restaurant.company_id where company.deleted_at=0 GROUP BY company.name,company.id,company.description";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function YemekleriGetir($restaurantId){
        include "db.php";
        $query="SELECT name from food where restaurant_id=:restaurantId";
        $statement=$pdo->prepare($query);
        $statement->execute(['restaurantId'=> $restaurantId]);
        $result=$statement-> fetchAll();
        $pdo=null;
        return $result;
    }
    function KuponGetir(){
        include "db.php";
        $query="SELECT id,name,discount from cupon";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement-> fetchAll();
        $pdo=null;
        return $result;
    }
    function YemekGetir($firmaId){
        include "db.php";
        $query="SELECT food.id,food.name,food.description,food.price from food INNER JOIN restaurant ON food.restaurant_id=restaurant.id where restaurant.company_id=:firmaId and food.deleted_at=0 ";
        $statement=$pdo->prepare($query);
        $statement->execute(['firmaId' => $firmaId]);
        $result=$statement-> fetchAll();
        $pdo=null;
        return $result;
    }

    function Login($kulAd){
        include "db.php";
        $query="SELECT id,company_id,role,username,sifre,balance FROM users where username=:username and deleted_at=0 ";
        $statement=$pdo->prepare($query);
        $statement->execute(['username'=> $kulAd ]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function firmaIDGetir($firmaIsim){
        include "db.php";
        $query="SELECT id from company where name=:firIsim";
        $statement=$pdo->prepare($query);
        $statement->execute(['firIsim' => $firmaIsim]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function kulKaydet($name,$surname,$kulAd,$sifre){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query = "INSERT INTO users (company_id, role, name, surname, username, sifre, created_at) VALUES (-1, 'Musteri', :name, :surname, :username, :sifre, :created_at)";
        $statement = $pdo->prepare($query);
        $statement->execute([
          'name' => $name,
          'surname' => $surname,
          'username' => $kulAd,
          'sifre' => $sifre,
          'created_at' => $tarih
        ]);
        $pdo = null;
    }
    function FirmaSiparişleriGetir($firmaId){
        include "db.php";
        $query="SELECT DISTINCT `order`.id from `order`
        JOIN order_items ON `order`.id=order_items.order_id
        JOIN food ON order_items.food_id=food.id
        JOIN restaurant ON food.restaurant_id=restaurant.id
        JOIN company ON restaurant.company_id=company.id
        where company.id=:firmaid and `order`.order_status!='Teslim Edildi'";
        $statement=$pdo->prepare($query);
        $statement->execute(['firmaid' => $firmaId]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function ProfilBilgileri($asd){
        include "db.php";
        $query="SELECT name,surname,username,balance from users where id=:musteriId";
        $statement=$pdo->prepare($query);
        $statement->execute(['musteriId' => $asd]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function SepeteEkle($user_id,$food_id,$note,$adet){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO basket(user_id,food_id,note,quantity,created_at) values (:userId,:foodId,:note,:adet,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'userId'=>$user_id,
            'foodId'=>$food_id,
            'note'=>$note,
            'adet'=>$adet,
            'tarih'=>$tarih
        ]);
        $pdo = null;
    }
    function TumYemekleriGetir(){
        include "db.php";
        $query="SELECT * FROM food where deleted_at=0";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function KullanıcıSepetiGetir($userId){
        include "db.php";
        $query="SELECT food_id,note,quantity from basket where user_id=:usr_id ";
        $statement=$pdo->prepare($query);
        $statement->execute(['usr_id' => $userId]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function IdYemekGetir($food_id){
        include "db.php";
        $query="SELECT name,price,discount from food where id=:fId and deleted_at=0";
        $statement=$pdo->prepare($query);
        $statement->execute(['fId' => $food_id]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function SiparişIdAl($user_id,$tarih){
        include "db.php";
        $query="SELECT id from `order` where user_id=:userId and created_at=:tarih";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'userId'=>$user_id,
            'tarih'=>$tarih
        ]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;
    }
    function SiparişItemHazırlık($user_id,$order_id){
        include "db.php";
        $query="SELECT basket.food_id,basket.quantity,food.price,food.discount from basket JOIN food ON food.id=basket.food_id where basket.user_id=:user_id";
        $statement=$pdo->prepare($query);
        $statement->execute(['user_id'=>$user_id]);
        $result=$statement->fetchAll();
        $pdo=null;
        foreach($result as $i)
        {
            $food_id=$i['food_id'];
            $adet=$i['quantity'];
            $fiyat=$i['price'];
            $indirim=$i['discount'];
            $price=$fiyat-$indirim;
            SiparişItemDoldur($food_id,$order_id,$adet,$price);
        }


    }
    function SiparişItemDoldur($food_id,$order_id,$quantity,$price){
        include "db.php";
        $query="INSERT INTO order_items(food_id,order_id,quantity,price) VALUES (:fiD,:oiD,:adet,:fiyat)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'fiD'=>$food_id,
            'oiD'=>$order_id,
            'adet'=>$quantity,
            'fiyat'=>$price
        ]);
        $pdo=null;
    }

    function SiparişKaydet($user_id,$price){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO `order`(user_id,order_status,total_price,created_at) VALUES (:userId,'Hazırlanıyor',:price,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'userId'=>$user_id,
            'price'=>$price,
            'tarih'=>$tarih
        ]);
        $pdo=null;
        $siparişId=SiparişIdAl($user_id,$tarih);
        $sip_id=$siparişId['id'];
        SiparişItemHazırlık($user_id,$sip_id);

    }
    function SepetTemzile($user_id){
        include "db.php";
        $query="DELETE FROM basket where user_id=:userId";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'userId'=>$user_id
        ]);
        $pdo=null;
    }
    function GeçmişSiparişler($user_id){
        include "db.php";
        $query="SELECT `order`.id,food.restaurant_id,restaurant.name as restAdi,GROUP_CONCAT(food.name SEPARATOR '-') as yemekAdi from `order`
        JOIN order_items ON `order`.id=order_items.order_id
        JOIN food ON order_items.food_id=food.id
        JOIN restaurant ON restaurant.id=food.restaurant_id
        where `order`.user_id=:userId and `order`.order_status='Teslim Edildi'
        GROUP BY `order`.id,restaurant.name";
        $statement=$pdo->prepare($query);
        $statement->execute(['userId'=>$user_id]);
        $result=$statement->fetchAll();
        return $result;
    }
    function YorumVarMi($order_id,$res_id,$user_id){
        include "db.php";
        $query="SELECT COUNT(*) AS adet from comments where order_id=:order_id and restaurant_id=:res_id and user_id=:user_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'order_id'=>$order_id,
            'res_id'=>$res_id,
            'user_id'=>$user_id
        ]);
        $result=$statement->fetch();
        return $result;

    }
    function YorumYap($user_id,$order_id,$res_id,$userrname,$title,$yorum,$puan){
        include "db.php";
        $varMi=YorumVarMi($order_id,$res_id,$user_id);
        $yorumAdedi=$varMi['adet'];
        if($yorumAdedi==0){
            $tarih=date('Y-m-d H:i:s');
            $query="INSERT INTO comments(user_id,restaurant_id,username,title,description,score,created_at,order_id) VALUES (:user_id,:res_id,:username,:title,:description,:score,:tarih,:order_id)";
            $statement=$pdo->prepare($query);
            $statement->execute([
                'user_id'=>$user_id,
                'res_id'=>$res_id,
                'username'=>$username,
                'title'=>$title,
                'description'=>$yorum,
                'score'=>$puan,
                'tarih'=>$tarih,
                'order_id'=>$order_id
            ]);
            $pdo=null;
        }
        else{
            $tarih=date('Y-m-d H:i:s');
            $query="UPDATE comments SET title=:baslik ,username=:usname,description=:yorum,score=:puan,updated_at=:tarih where user_id=:user_id and order_id=:order_id and restaurant_id=:res_id";
            $statement=$pdo->prepare($query);
            $statement->execute([
                'baslik'=>$title,
                'yorum'=>$yorum,
                'puan'=>$puan,
                'tarih'=>$tarih,
                'user_id'=>$user_id,
                'order_id'=>$order_id,
                'res_id'=>$res_id,
                'usname'=>$userrname
            ]);
            $pdo=null;
        }

    }
    function YorumGetir(){
        include "db.php";
        $query="SELECT comments.title,comments.description,comments.score,comments.restaurant_id,restaurant.name from comments
        JOIN restaurant ON restaurant.id=comments.restaurant_id";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function RestOrtPuan($res_id){
        include "db.php";
        $query="SELECT AVG(score) as ortPuan from comments where restaurant_id=:res_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'res_id'=>$res_id
        ]);
        $result=$statement->fetch();
        $pdo=null;
        return $result;

    }
    function UcretDus($user_id,$fiyat){
        $bakiye=$_SESSION['balance'];
        $yeniBakiye=$bakiye-$fiyat;
        include "db.php";
        $query="UPDATE users Set balance=:balance where id=:usr_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'balance'=>$yeniBakiye,
            'usr_id'=>$user_id
        ]);
        $pdo=null;
        $_SESSION['balance']=$yeniBakiye;
    }
    function KulBilgiDegis($user_id,$name,$surname,$usernamee){
        include "db.php";
        $query="UPDATE users SET name=:name , surname=:surname, username=:username where id=:user_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'name'=>$name,
            'surname'=>$surname,
            'username'=>$usernamee,
            'user_id'=>$user_id
        ]);
        $pdo=null;
        $_SESSION["username"]=$username;
    }
    function SifreDegistir($user_id,$sifre){
        include "db.php";
        $query="UPDATE users SET sifre=:sifre where id=:user_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'sifre'=>$sifre,
            'user_id'=>$user_id
        ]);
        $pdo=null;
    }
    function AdminKulSip($user_id){
        include "db.php";
        $query="SELECT id,order_status,total_price from `order` where user_id=:user_id and order_status!='Teslim Edildi'";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'user_id'=>$user_id
        ]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function KulSoftSil($user_id){
        include "db.php";
        $query="UPDATE users SET deleted_at=1 where id=:user_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'user_id'=>$user_id
        ]);
        $pdo=null;
    }
    function KuponSil($kuponID){
        include "db.php";
        $query="DELETE from cupon where id=:kup_id";
        $statement=$pdo->prepare($query);
        $statement->execute(['kup_id'=>$kuponID]);
        $pdo=null;
    }
    function KuponEkle($res_id,$name,$discount){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO cupon(restaurant_id,name,discount,created_at) VALUES (:res_id,:name,:discount,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'res_id'=>$res_id,
            'name'=>$name,
            'discount'=>$discount,
            'tarih'=>$tarih
        ]);
        $pdo=null;
    }
    function KuponRestGetir(){
        include "db.php";
        $query="SELECT id,name from restaurant";
        $statement=$pdo->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function AdminYemekGetir($res_id){
        include "db.php";
        $query="SELECT name from food where restaurant_id=:rest_id";
        $statement=$pdo->prepare($query);
        $statement->execute(['rest_id'=>$res_id]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function FirmaSil($comp_id){
        include "db.php";
        $query="UPDATE company SET deleted_at=1 where id=:comp_id";
        $statement=$pdo->prepare($query);
        $statement->execute(['comp_id'=>$comp_id]);
        $pdo=null;
    }
    function FirmaGuncelle($nameee,$descriptionnn,$comp_iddd){
        include "db.php";
        $query="UPDATE company SET name=:name, description=:aciklama where id=:comp_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'comp_id'=>$comp_iddd,
            'name'=>$nameee,
            'aciklama'=>$descriptionnn
        ]);
        $pdo=null;
    }
    function FirmaRestGetir($firmaId){
        include "db.php";
        $query="SELECT id,name from restaurant where company_id=:comp_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'comp_id'=>$firmaId
        ]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function YemekEkle($restID,$isim,$aciklama,$fiyat){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO food(restaurant_id,name,description,price,created_at) VALUES (:rest_id,:name,:aciklama,:fiyat,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'rest_id'=>$restID,
            'name'=>$isim,
            'aciklama'=>$aciklama,
            'fiyat'=>$fiyat,
            'tarih'=>$tarih
        ]);
        $pdo=null;
    }
    function YemekSil($food_id){
        include "db.php";
        $query="UPDATE food SET deleted_at=1 where id=:yemekID";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'yemekID'=>$food_id
        ]);
        $pdo=null;
    }
    function SipDetayGetir($order_id){
        include "db.php";
        $query="SELECT `order`.order_status,`order`.total_price,`order`.created_at,order_items.quantity,food.name from `order`
        JOIN order_items ON `order`.id=order_items.order_id
        JOIN food ON order_items.food_id=food.id
        WHERE `order`.id=:order_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'order_id'=>$order_id
        ]);
        $result=$statement->fetchAll();
        $pdo=null;
        return $result;
    }
    function SipDurumGuncelle($order_id,$durum){
        include "db.php";
        $query="UPDATE `order` SET order_status=:ordDurum where id=:order_id";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'ordDurum'=>$durum,
            'order_id'=>$order_id
        ]);
        $pdo=null;
    }
    function FirmaEkle($isim,$hakkinda,$kulAd,$sifre){
        include "db.php";
        $query="INSERT INTO company(name,description) Values (:name,:aciklama)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'name'=>$isim,
            'aciklama'=>$hakkinda
        ]);
        
        $firmaId=firmaIDGetir($isim);
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO users(company_id,role,name,surname,username,sifre,created_at) VALUES (:compID,'Firma',:isim,'Firma',:username,:sifre,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'compID'=>$firmaId['id'],
            'isim'=>$isim,
            'username'=>$kulAd,
            'sifre'=>$sifre,
            'tarih'=>$tarih
        ]);
        $pdo=null;
    }
    function RestEkle($comp_id,$isim,$aciklama){
        include "db.php";
        $tarih=date('Y-m-d H:i:s');
        $query="INSERT INTO restaurant(company_id,name,description,created_at) VALUES (:compID,:name,:aciklama,:tarih)";
        $statement=$pdo->prepare($query);
        $statement->execute([
            'compID'=>$comp_id,
            'name'=>$isim,
            'aciklama'=>$aciklama,
            'tarih'=>$tarih
            
        ]);
        $pdo=null;
    }
?>