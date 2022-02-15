<?php
 
	session_start();
	$url = "location:".$_GET['url'];
	unset($_SESSION['cart']);
	
	header($url);


?>