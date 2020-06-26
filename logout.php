<?
	session_start();
	session_destroy();
	$message = "Logout successful, have a nice day!";
	
	echo "<script>alert('$message'); 
	location.href = 'index.php';</script>";

?>