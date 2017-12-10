<?php 
	include "json_config.php";
	
	
	$database =$db;
	if ($database) {
		$utf = "SET NAMES 'utf8'";
		mysqli_query($database,$utf);
		$query = "SELECT * FROM test";

		if (isset($_GET['id'])) {
			$query = $query.' WHERE id = '.$_GET['id'];
			$result = mysqli_query($database,$query);
			$data = $result->fetch_assoc();
		} else {
			$result = mysqli_query($database,$query);
			$data = array();
			while($row = $result->fetch_assoc()){
				$data[]=$row;
			}
		}
		
		echo json_encode($data);

	}else{
		die("Baglanırken hata oluştu");
	}
 ?>