package main

import (
	"bufio"
	"flag"
	"fmt"
	"os"

	"golang.org/x/crypto/ssh"
)

// var nFlag = flag.Int("n", 1234, "help message for flag n")
var hFlag = flag.String("h", "null", "-h *.*.*.* şeklinde ip adresinizi tanımlayın")

var pFlag = flag.String("p", "null", "-p <password> ")
var PFlagWordlist = flag.String("P", "null", "dosya konumunu girin")

var uFlag = flag.String("u", "null", "-u <username>")
var UFlagWordlist = flag.String("U", "null", "dosya konumunu girin")

func sshBaglanti(kulAd string, sifre string, IP string) error {
	config := &ssh.ClientConfig{
		User: kulAd,
		Auth: []ssh.AuthMethod{
			ssh.Password(sifre),
		},
		HostKeyCallback: ssh.InsecureIgnoreHostKey(),
	}

	client, err := ssh.Dial("tcp", IP, config)
	if err != nil {
		return err
	}
	defer client.Close()
	fmt.Printf("Bağlantı Sağlandı")
	return nil

}
func WordlistOku(DosyaYol string) ([]string, error) {
	var satır []string
	file, err := os.Open(DosyaYol)
	if err != nil {
		return nil, err
	}
	defer file.Close()
	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		satır = append(satır, scanner.Text())
	}
	return satır, scanner.Err()
}
func main() {
	flag.Parse()
	if *hFlag != "null" {
		if *uFlag != "null" {
			if *pFlag != "null" {
				err := sshBaglanti(*uFlag, *pFlag, *hFlag)
				if err == nil {
					fmt.Print("Bağlantı sağlandı" + "Kullanıcı Adı: " + *uFlag + " Şifre: " + *pFlag)
				}
			} else if *PFlagWordlist != "null" {
				sifreWordlist, err := WordlistOku(*PFlagWordlist)
				if err == nil {
					for _, a := range sifreWordlist {
						fmt.Print("Bağlantı Deneniyor " + *uFlag + ":" + a)
						err = sshBaglanti(*uFlag, a, *hFlag)
						if err != nil {
							fmt.Printf("hata")
						} else {
							fmt.Printf("Bağlantı başarılı")
							break
						}
					}
				}
			} else {
				fmt.Printf("Şifre Girilmemiş")
			}

		} else if *UFlagWordlist != "null" {
			if *pFlag != "null" {
				usernameWordList, err := WordlistOku(*UFlagWordlist)
				if err == nil {
					for _, a := range usernameWordList {
						fmt.Print("Bağlantı Deneniyor " + a + ":" + *pFlag)
						err = sshBaglanti(a, *pFlag, *hFlag)
						if err != nil {
							fmt.Printf("hata")
						} else {
							fmt.Printf("Bağlantı başarılı")
							break
						}
					}
				}
			} else if *PFlagWordlist != "null" {
				usernameWordList, err := WordlistOku(*UFlagWordlist)
				sifreWordlist, errSif := WordlistOku(*PFlagWordlist)
				if err == nil {
					if errSif == nil {
						for _, u := range usernameWordList {
							for _, p := range sifreWordlist {
								fmt.Print("Bağlantı Deneniyor " + u + ":" + p)
								err = sshBaglanti(u, p, *hFlag)
								if err != nil {
									fmt.Printf("hata")
								} else if errSif != nil {
									fmt.Printf("hata")
								} else {
									fmt.Printf("Bağlantı başarılı")
									break
								}
							}

						}
					}

				}
			} else {
				fmt.Printf("Şifre Girilmemiş")
			}
		} else {
			fmt.Print("Kullanıcı adı veya wordlist girilmemiş")
		}

	} else {
		fmt.Print("Geçersiz IP Adresi")
	}
}
