<?php 
	// Php webservis kullanımı için alınan izinler	
    header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Methods: POST,GET,OPTIONS, DELETE,PUT');

	header('Cache-Control:public, max-age=100');

	// Veritabanı baglantısı için istenilen bilgiler
	define("host","localhost");
	define("user","root");
	define("pass","");
	define("db","giyenesor");

	// Veritabanına baglı olup olmadıgını kontrol eder.
	$db =mysqli_connect(host,user,pass,db)or die("Baglantı Gerçekleştirilemedi ! ");

?>