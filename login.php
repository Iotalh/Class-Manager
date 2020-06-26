<?
if(isset($_POST['login_info'])){
	session_start();	
	if(isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
		if(isset($_POST["username"]) && isset($_POST["passwd"])){
			require_once("connectMysql.php");
			$sql_query = "SELECT * FROM admin";
			$result = $db_link->query($sql_query);
			$row_result=$result->fetch_assoc();
			$username = $row_result["Id"];
			$hashValue = $row_result["hashValue"];
            $db_link->close();
            $password_check = password_verify ( $_POST["passwd"] ,  $hashValue);

			if(($username==$_POST["username"]) && ($password_check == 'true')){
				$_SESSION["loginMember"]=$username;
				$message="登入成功";
				echo "<script>alert('$message'); location.href='board.php';</script>";
			}else if($username!=$_POST["username"]){
				$message="username error, please relogin";
				echo "<script>alert('$message'); location.href='login.php';</script>";
			}else if($passwd!=$_POST["passwd"]){
				$message="password error, please relogin";
				echo "<script>alert('$message'); location.href='login.php';</script>";
			}
		}
	}
}
	
?>
<!DOCTYPE html>
<html lang="en">
<title>登入</title>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container border border-secondary rounded">
		<div class="row">
			<div class="col-sm">
				<h1 class="font-weight-bolder text-center">課程評論管理系統</h1>
			</div>
		</div>
		<form method="POST" name = "loginMember" action = "">

      		<label for="uname"><b>Username</b></label>
     		<input type="text" placeholder="Enter ID" name="username" required>

      		<label for="psw"><b>Password</b></label>
      		<input type="password" placeholder="Enter Password" name="passwd" required>
        
   			<button type="submit" name = "login_info">Login</button>
   		</div>

		</form>
	</div>
</body>
</html>
