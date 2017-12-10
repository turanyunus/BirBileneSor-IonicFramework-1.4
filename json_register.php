<?php
    // Sabit olarak tanımladıgımız, Veritabanına baglanma sayfasını cagırdık. 
 	   include "json_config.php";

		/* POST EDİLEN DEĞERLERİN BOŞ GELİP GELMEDİĞİ KONTROL EDİLİYOR */
	    if(!(empty($_POST['kadi']) || empty($_POST['sifre']) || empty($_POST['sifret']) || empty($_POST['email']))){

			/* BURDA POST EDİLİR VE GÜVENLİK İŞLEMLERİ YAPILIR */
            $kadi = htmlspecialchars(trim($_POST['kadi']));
			$sifre = htmlspecialchars(trim($_POST['sifre']));
			$sifret = htmlspecialchars(trim($_POST['sifret']));
			$email = htmlspecialchars(trim($_POST['email']));
			
			/* KULLANICI ADI KONTROLU */
            if (strlen($kadi) < 6){
			    echo "Kullanıcı Adınız en az 6 karakter olmalıdır.";
				return;
			}

			/* SİFRE KONTROLU */
            if (strlen($sifre) < 6){
			    echo "Şifreniz en az 6 karakter olmalıdır.";
				return;
			}
			
			/*ŞİFRE TEKRAR KONTROLU*/
			if ($sifre != $sifret) {
				echo "Sifreler birbiri ile bagdaşmıyor";
				return;
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){ 
				echo 'e-posta gecersiz';
				return;
			}
		
			/* SÖZLEŞME ONAYLA CHECKBOX'I BAŞLAR*/			
			if ($_POST['oonay'] == "true"){

				/* KONTROLLERDEN GEÇTİKTEN SONRA DB EKLEME İŞLEMİ YAPILIR BURDA BAŞLAR */
				$query = "SELECT * FROM test WHERE username = '$kadi'";
				$result = mysqli_query($db,$query);
				if($row = $result->fetch_assoc()){
					echo "Farklı bir kullanıcı adı belirleyiniz.";
					return;
				}else{
					$query = "INSERT INTO test(username,sifre,name) VALUES('$kadi','$sifre','$email')";
					if (!mysqli_query($db,$query)){
					die('Errorrr: '.mysqli_error());
					}
					return;
					}
					/* KONTROLLERDEN GEÇTİKTEN SONRA DB EKLEME İŞLEMİ YAPILIR BURDA BİTER */

				}else{	
				echo "Sözleşmeyi Onaylayınız";
				}		
				/* SÖZLEŞME ONAYLA CHECKBOX'I BİTER */	
		}else{
			echo "Girilecek Alanlar boş bırakılamaz";
		}
	
 ?>