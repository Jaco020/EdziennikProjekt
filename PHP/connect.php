<?php
	$host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "edziennik";
	$polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name);
	mysqli_set_charset($polaczenie,"utf8");
	if(!$polaczenie){
		die("Connection failed".mysqli_connect_error());
	};
?>