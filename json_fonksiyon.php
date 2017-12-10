<?php
	/* HAZIR KULLANILAN FONKSİYOLAR */
	function p($par,$st=false){
		if ($st) {
			return htmlspecialchars(trim($_POST[$par]));
		}else {
			return trim($_POST[$par]);
		}
	}

	function g($par){
		return strip_tags(trim($_GET[$par]));
	}

	function ss($par){
		return stripslashes($par);
	}

	function kisalt($par,$uzunluk=50){
		if(strlen($par)>$uzunluk){
			$par = mb_substr($par,0,$uzunluk,"UTF-8")."..";
		}
		return $par;
	}

	function session($par){
		if ($_SESSION[$par]) {
			return $_SESSION[$par];
		}else{
			return false;
		}
	}

	function cookie($par){
		if ($_COOKIE[$par]) {
			return $_COOKIE[$par];
		}else{
			return false;
		}
	}


	function session_olustur($par){
		foreach ($par as $anahtar => $deger) {
			$_SESSION[$anahtar] = $deger;
		}
	}

	function sef_link($baslik){
		$bul=array('Ç','Ş','Ğ','Ü','İ','Ö','ç','ş','ğ','ü','ö','ı','-');
		$yap=array('c','s','g','u','i','o','c','s','g','u','o','i',' ');
		$perma =strtolower(str_replace($bul, $yap, $baslik));
		$perma = preg_replace('@[^A-Za-z0-9\-_]@i', ' ', $perma);
		$perma = trim(preg_replace('/\s+/', ' ', $perma));
		$perma = str_replace(' ', '-', $perma); 
		return $perma;
	}

	function query($query){
		return mysql_query($query);
	}

	function row($query){
		return mysql_fetch_array($query);
	}

	function rows($query){
		return mysql_num_rows($query);
	}

	function go($par,$time=0){
		if ($time == 0) {
			header("Location : {$par}");
		}else{
			header("Refresh : {$time}; url ={$par}");
		}
	}
	}
 ?>