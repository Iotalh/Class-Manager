<?
	session_start();
	if(isset($_SESSION["userName"]) != NULL){
		session_destroy();
		$message = "Logout successful, have a nice day!";
	}else{
		echo "You havn't login yet, please try again!";
		$message = "You havn't login yet, please try again!";
	}
	echo "<script>alert('$message');</script>";
	echo "<script>location.href = 'index.php';</script>";

?>