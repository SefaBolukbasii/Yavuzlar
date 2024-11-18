package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
)

func main() {
	var kullaniciTur int
	var kulAd string
	var sifre string
	var komut string
	var satırNumarası int
	var yeniKulAd string
	var yeniKulSif string
	var silinecekKulAd string
	var lines []string
	var yeniSif string
	fmt.Println("Kullanıcı Türünü Seçiniz")
	fmt.Println("Admin için 0 giriniz")
	fmt.Println("Kullanıcı için 1 giriniz")
	fmt.Scanln(&kullaniciTur)
	fmt.Print("Kullanıcı Adı: ")
	fmt.Scan(&kulAd)
	fmt.Print("Şifre: ")
	fmt.Scan(&sifre)
	girisBasariliMi := 0
	if kullaniciTur == 0 {
		file, err := os.Open("admin.txt")
		if err != nil {
			log.Fatal(err)
		}
		defer file.Close()
		scanner := bufio.NewScanner(file)
		for scanner.Scan() {
			satırNumarası++
			if kulAd == scanner.Text() {
				scanner.Scan()
				if sifre == scanner.Text() {
					girisBasariliMi = 1
					break
				}
			}
		}
		file, err = os.OpenFile("log.txt", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
		if err != nil {
			fmt.Println("Dosya açılamadı:", err)
			return
		}
		defer file.Close()
		if girisBasariliMi == 1 {
			_, err = file.WriteString(kulAd + " Başarılı Giriş" + "\n")
			fmt.Println("1- Musteri Ekleme")
			fmt.Println("2- Musteri Silme")
			fmt.Println("3- Log Listeleme")
			fmt.Scan(&komut)

			if komut == "1" {
				fmt.Print("Kullanıcı Adı:")
				fmt.Scan(&yeniKulAd)
				fmt.Print("Şifre: ")
				fmt.Scan(&yeniKulSif)
				file, err = os.OpenFile("kullanicilar.txt", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
				defer file.Close()
				_, err = file.WriteString(yeniKulAd + "\n")
				_, err = file.WriteString(yeniKulSif + "\n")
			} else if komut == "2" {
				fmt.Print("Kullanıcı Adı:")
				fmt.Scan(&silinecekKulAd)
				file, err = os.Open("kullanicilar.txt")
				defer file.Close()
				scanner = bufio.NewScanner(file)
				for scanner.Scan() {
					if scanner.Text() != silinecekKulAd {
						lines = append(lines, scanner.Text())
					} else {
						scanner.Scan()
					}
				}
				file, err = os.Create("kullanicilar.txt")
				defer file.Close()
				for _, line := range lines {
					_, err = file.WriteString(line + "\n")
				}

			} else if komut == "3" {
				file, err = os.Open("log.txt")
				defer file.Close()
				scanner = bufio.NewScanner(file)
				for scanner.Scan() {
					fmt.Println(scanner.Text())
				}

			} else {
				fmt.Println("Geçersiz Komut Girdiniz")
			}
		} else {
			_, err = file.WriteString(kulAd + " Hatalı Giriş" + "\n")
		}

	} else if kullaniciTur == 1 {
		file, err := os.Open("kullanicilar.txt")
		if err != nil {
			log.Fatal(err)
		}
		defer file.Close()
		scanner := bufio.NewScanner(file)
		for scanner.Scan() {
			satırNumarası++
			if kulAd == scanner.Text() {
				scanner.Scan()
				if sifre == scanner.Text() {
					girisBasariliMi = 1
					break
				}
			}
		}
		file, err = os.OpenFile("log.txt", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
		if err != nil {
			fmt.Println("Dosya açılamadı:", err)
			return
		}
		defer file.Close()
		if girisBasariliMi == 1 {
			_, err = file.WriteString(kulAd + " Başarılı Giriş" + "\n")
			fmt.Println("1- Profil Görüntüleme")
			fmt.Println("2- Şifre Değiştirme")
			fmt.Scan(&komut)
			if komut == "1" {

			} else if komut == "2" {
				fmt.Print("Yeni Şifre: ")
				fmt.Scan(&yeniSif)
				file, err = os.Open("kullanicilar.txt")
				defer file.Close()
				scanner = bufio.NewScanner(file)
				for scanner.Scan() {
					if scanner.Text() != kulAd {
						lines = append(lines, scanner.Text())
					} else {
						lines = append(lines, scanner.Text())
						scanner.Scan()
						lines = append(lines, yeniSif)
					}
				}
				file, err = os.Create("kullanicilar.txt")
				defer file.Close()
				for _, line := range lines {
					_, err = file.WriteString(line + "\n")
				}
			} else {
				fmt.Println("Geçersiz Komut Girdiniz")
			}

		} else {
			_, err = file.WriteString(kulAd + " Hatalı Giriş" + "\n")
		}

	}
}
