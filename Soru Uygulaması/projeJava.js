var sorular = [];
var soru1 = ["deneme1", "ineğin kaç ayağı var", "5", "7", "8", "4", "D"];
var soru2 = ["deneme2", "ineğin kaç ayağı var", "5", "7", "9", "4", "D"];

//soru adı,soru,a,b,c,d,doğru cevap
//   0    ,  1 ,2,3,4,5,6
sorular.push(soru1);
sorular.push(soru2);
var randomIndex = 0;
function diziDoldur() {
  for (var i = 0; i < localStorage.length; i++) {
    var key = localStorage.key(i);
    var dizi = localStorage.getItem(key);
    dizi = JSON.parse(dizi);
    sorular.push(dizi);
  }
}
function doldur() {
  for (var i = 0; i < sorular.length; i++) {
    var divEkle = document.createElement("div");
    divEkle.className = "yonetimSorular";
    divEkle.innerHTML =
      "<div><p>" +
      sorular[i][0] +
      "</p></div><div class='linklerSınıf' ><a href='#' onclick='duzenle(this)' >Düzenle</a><a href='#' onclick='sil(this)'>Sil</a></div>";
    var container = document.getElementById("container");
    container.appendChild(divEkle);
  }
}
function sil(element) {
  var yakınDiv = element.closest(".yonetimSorular");
  var pİçeriği = yakınDiv.querySelector("p").textContent;
  yakınDiv.remove();
  for (var i = 0; i < sorular.length; i++) {
    if (pİçeriği == sorular[i][0]) {
      sorular.splice(i, 1);
      localStorage.removeItem(pİçeriği);
    }
  }
}
function duzenle(element) {
  var yakınDiv = element.closest(".yonetimSorular");
  var pİçeriği = yakınDiv.querySelector("p").textContent;
  var url = "duzenle.html?pIcerik=" + encodeURIComponent(pİçeriği);
  window.location.href = url;
}
function urlsorgu(param) {
  var urlParameter = new URLSearchParams(window.location.search);
  return urlParameter.get(param);
}
function duzDoldur() {
  var pIcerik = urlsorgu("pIcerik");
  if (pIcerik) {
    for (var i = 0; i < sorular.length; i++) {
      if (sorular[i][0] == pIcerik) {
        document.getElementById("input1").value = sorular[i][0];
        document.getElementById("input2").value = sorular[i][1];
        document.getElementById("input3").value = sorular[i][2];
        document.getElementById("input4").value = sorular[i][3];
        document.getElementById("input5").value = sorular[i][4];
        document.getElementById("input6").value = sorular[i][5];
        document.getElementById("input7").value = sorular[i][6];
        document.getElementById("input8").value = sorular[i][7];
      }
    }
  }
}
function değiştir() {
  var pIcerik = urlsorgu("pIcerik");
  if (pIcerik) {
    for (var i = 0; i < sorular.length; i++) {
      if (sorular[i][0] == pIcerik) {
        sorular[i][0] = document.getElementById("input1").value;
        sorular[i][1] = document.getElementById("input2").value;
        sorular[i][2] = document.getElementById("input3").value;
        sorular[i][3] = document.getElementById("input4").value;
        sorular[i][4] = document.getElementById("input5").value;
        sorular[i][5] = document.getElementById("input6").value;
        sorular[i][6] = document.getElementById("input7").value;
        sorular[i][7] = document.getElementById("input8").value;
        localStorage.setItem(pIcerik, JSON.stringify(sorular[i]));
      }
    }
  }
}
function araBul() {
  var input = document.getElementById("soruAra");
  input.addEventListener("keydown", function (event) {
    if (event.key == "Enter") {
      var container = document.getElementById("container");
      while (container.firstChild) {
        container.removeChild(container.firstChild);
      }
      var girilenVeri = input.value;
      for (var i = 0; i < sorular.length; i++) {
        if (girilenVeri == sorular[i][0]) {
          var divEkle = document.createElement("div");
          divEkle.className = "yonetimSorular";
          divEkle.innerHTML =
            "<div><p>" +
            sorular[i][0] +
            "</p></div><div class='linklerSınıf' ><a href='#' onclick='duzenle(this)' >Düzenle</a><a href='#' onclick='sil(this)'>Sil</a></div>";
          var container = document.getElementById("container");
          container.appendChild(divEkle);
        }
      }
    }
  });
}
function soruGetir() {
  var container = document.getElementById("soruContainer");
  while (container.firstChild) {
    container.removeChild(container.firstChild);
  }
  randomIndex = Math.floor(Math.random() * sorular.length);
  var soruDiv = document.createElement("div");
  soruDiv.className = "soruDiv";
  soruDiv.innerHTML =
    "<div class='soruParagraf'><p>" +
    sorular[randomIndex][1] +
    "</p></div><div><form action='soruEkle.html'><div class='secenek'><input type='radio' id='a' name='secenekler' value='A' onchange='dogrulukKontrol(this)'><label for='a'>" +
    sorular[randomIndex][2] +
    "</label></div><div class='secenek'><input type='radio' id='b' name='secenekler' value='B' onchange='dogrulukKontrol(this)'><label for='b'>" +
    sorular[randomIndex][3] +
    "</label></div><div class='secenek'><input type='radio' id='c' name='secenekler' value='C' onchange='dogrulukKontrol(this)'><label for='c'>" +
    sorular[randomIndex][4] +
    "</label></div><div class='secenek'><input type='radio' id='d' name='secenekler' value='D' onchange='dogrulukKontrol(this)'><label for='d'>" +
    sorular[randomIndex][5] +
    "</label></div></form></div>";
  container.appendChild(soruDiv);
}
function veriAl() {
  var soruIsmi = document.getElementById("soruAdı").value;
  var soru = document.getElementById("soru").value;
  var Asecenegi = document.getElementById("cevapA").value;
  var Bsecenegi = document.getElementById("cevapB").value;
  var Csecenegi = document.getElementById("cevapC").value;
  var Dsecenegi = document.getElementById("cevapD").value;
  var dogruCevap = document.getElementById("cevapDoğru").value;
  var zorluk = document.getElementById("zorluk").value;
  var eklenecekSoru = [
    soruIsmi,
    soru,
    Asecenegi,
    Bsecenegi,
    Csecenegi,
    Dsecenegi,
    dogruCevap,
    zorluk,
  ];
  localStorage.setItem(soruIsmi, JSON.stringify(eklenecekSoru));
}
function dogrulukKontrol(radioButon) {
  if (radioButon.checked) {
    var isaretliSecenek = radioButon.value;
    if (sorular[randomIndex][6].toUpperCase() == isaretliSecenek) {
      alert("Doğru Cevap");
    } else {
      alert("Yanlış Cevap");
    }
  }
}
diziDoldur();
