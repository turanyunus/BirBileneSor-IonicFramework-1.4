<?php 
 	// Sabit olarak tanımladıgımız, Veritabanına baglanma sayfasını cagırdık.
	 include "json_config.php";

	 // DB CAGIRIP FARKLI DEĞİŞKENE ATADIM
	 $dbcon =$db;

	 // HAZIR SINIF KULLANDIM VE DB KONTROLU YAPILDI
	$responseData = new stdClass();
	if ($dbcon) {
		$utf = "SET NAMES 'utf8'";
		mysqli_query($dbcon,$utf);
		//LOGİN İŞLEMLERİ BURADA YAPILDI
		if(isset($_GET['kadi']) && isset($_GET['sifre'])){
			$kadi = htmlspecialchars(trim($_GET['kadi']));
			$sifre = htmlspecialchars(trim($_GET['sifre']));
			$query = "SELECT * FROM test WHERE username = '$kadi' and sifre = '$sifre'";
			$result = mysqli_query($dbcon,$query);
			if($row = $result->fetch_assoc()){
				$responseData->data = $row;
				echo json_encode($responseData);
			}else{
				$responseData->errorMessage = 'Hatali kullanici adi/sifre.';
				echo json_encode($responseData);
			}
		}else{
			$responseData->errorMessage = 'Girilecek Alanlar boş bırakılamaz';
			echo json_encode($responseData);
		}	
	}else{	
		$responseData->errorMessage = 'Veritabanına baglanamadı';
		echo json_encode($responseData);
	}
 ?>