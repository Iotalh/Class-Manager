<?
	session_start();
	if(!isset($_SESSION["userName"]) || ($_SESSION["userName"] =="")){
		header("Location: index.php");
	}
	if(isset($GET["logout"]) && ($_GET["logout"] == "true")){
		unset($_SESSION["userName"]);
		unset($_SESSION["userRole"]);
		unset($_SESSION["studentId"]);
		unset($_SESSION["department"]);
		echo"<script>alert('logout success');
		//location.herf='board.php';</script";
	}

?>