<?php
	if(isset($_GET['menu'])){
		$menu = $_GET['menu'];
		include "detail.php";
	}else{
		include "home.php";
	}
?>