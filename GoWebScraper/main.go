package main

import (
	"fmt"
	"net/http"
	"strings"

	"github.com/PuerkitoBio/goquery"
)

func main() {
	var komut string
	fmt.Println("Hacker News İçeriği İçin  --> 1")
	fmt.Println("Donanım Haber İçeriği İçin  --> 2")
	fmt.Println("Shift Delete İçeriği İçin  --> 3")
	fmt.Println("Çıkış İçin  --> 4")
	fmt.Scanln(&komut)

	if komut == "1" {
		Site1()
	} else if komut == "2" {
		Site2()
	} else if komut == "3" {
		Site3()
	} else if komut == "4" {
		return
	} else {
		fmt.Println("Hatalı bir giriş yaptınız")
	}

}
func Site1() {
	res, _ := http.Get("https://thehackernews.com/")
	if res.StatusCode != 200 {
		fmt.Println("Hata", res.StatusCode)
		return
	}
	doc, _ := goquery.NewDocumentFromReader(res.Body)
	doc.Find(".body-post.clear .clear.home-right").Each(func(i int, s *goquery.Selection) {
		baslik := s.Find(".home-title").Text()
		icerik := s.Find(".home-desc").Text()
		tarih := s.Find(".h-datetime").Text()
		fmt.Println(i+1, " : ", baslik)
		fmt.Println("İçerik Tarihi : ", tarih)
		fmt.Println()
		fmt.Println(icerik)
		fmt.Println("-------------------------------------------------------------")
	})
}
func Site2() {
	res, _ := http.Get("https://www.donanimhaber.com/teknoloji-haberleri")
	if res.StatusCode != 200 {
		fmt.Println("Hata", res.StatusCode)
		return
	}
	doc, _ := goquery.NewDocumentFromReader(res.Body)
	doc.Find(".medya-yatay.pager-item.blogItem .govde").Each(func(i int, s *goquery.Selection) {
		baslik := s.Find("h3").Text()
		icerik := s.Find(".aciklama").Text()
		fmt.Println(i+1, " : ", strings.TrimSpace(baslik))
		fmt.Println()
		fmt.Println(icerik)
		fmt.Println("-------------------------------------------------------------")
	})
}
func Site3() {
	res, _ := http.Get("https://shiftdelete.net/teknoloji-haberleri")
	if res.StatusCode != 200 {
		fmt.Println("Hata", res.StatusCode)
		return
	}
	doc, _ := goquery.NewDocumentFromReader(res.Body)
	doc.Find(".sidebar-container .post-inner-content").Each(func(i int, s *goquery.Selection) {
		baslik := s.Find(".post-title h4 a").Text()
		icerik := s.Find(".post-excerpt p").Text()
		fmt.Println(i+1, " : ", strings.TrimSpace(baslik))
		fmt.Println()
		fmt.Println(icerik)
		fmt.Println("-------------------------------------------------------------")
	})
}
