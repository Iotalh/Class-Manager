<?
	session_start();
	if(isset($_SESSION["userName"]) != NULL){
		$_SESSION["id"] = NULL;
		$_SESSION["userName"] = NULL;
		$_SESSION["userRole"] = NULL;
		$_SESSION["studentId"] = NULL;
		$_SESSION["department"] = NULL;

		$message = "Logout successful, have a nice day!";
		echo "<script>alert('$message');</script>";
	}else{
		echo "You havn't login yet, please try again!";
	}
	echo "<script>location.href = 'index.php';</script>";

?>