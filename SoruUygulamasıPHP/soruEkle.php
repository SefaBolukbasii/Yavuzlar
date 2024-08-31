<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <script src="projeJava.js"></script>
  </head>
  <body>
    <div class="soruEkleCon">
      <form action="addQuestionQuery.php" method="POST">
        <input type="text" id="soruAdı" name="soruAdı" placeholder="Soru İsmi" />
        <input type="text" id="soru"    name="soru"    placeholder="Soru" />
        <input type="text" id="cevapA"  name="cevapA"  placeholder="A seçeneği" />
        <input type="text" id="cevapB"  name="cevapB"  placeholder="B seçeneği" />
        <input type="text" id="cevapC"  name="cevapC"  placeholder="C seçeneği" />
        <input type="text" id="cevapD"  name="cevapD"  placeholder="D seçeneği" />
        <input
          type="text"
          id="cevapDoğru"
          name="cevapDoğru"
          placeholder="Doğru Cevap Şıkkı (A-B-C-D)"
        />
        <input
          type="text"
          id="zorluk"
          name="zorluk"
          placeholder="Soru zorluğu (kolay-orta-zor)"
        />
        <button type="submit">Oluştur</button>
      </form>
    </div>
  </body>
</html>
