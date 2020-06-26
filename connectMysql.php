<?
	$db_host = "localhost";
	$db_username = "board";
	$db_password = "1111";
	$db_name = "class_manager";
	$db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
	if($db_link -> connect_error != ""){
		echo "connect fail!";
	}
	else{
		$db_link -> query("SET NAMES 'utf8'");
	}
