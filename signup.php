<?
if(isset($_POST['submit_info'])){
	
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<title>註冊</title>
	<style>
		body {
			background: skyblue;
		}
		* {
			font-family:"標楷體";
		}
		.container {
			background: white;
 			text-align: center;
			margin-right: auto;
			margin-left: auto;
			padding-right: 15px;
			padding-left: 15px;
			width: 50%;
			max-width: 1140px;
		}
		img.sex {
			width:25px;
		}
		span {
			font-size: 10px;
		}
		img.smIcon {
			border: 0;
			width: 16px;
		}
		.select {
  			position: relative;
  			font-family: Arial;
 			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container border border-secondary rounded">
		<div class="row">
			<div class="col-sm">
				<h1 class="font-weight-bolder text-center">課程評論管理系統</h1>
			</div>
		</div>
		<br>
			<form method="POST" name = "formPost" action = "" onSubmit="return checkForm();">


			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">姓名</span>
				</div>
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="name" id="name">
			</div>


			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">學號</span>
				</div>
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="Id" id="Id">
			</div>



			<div class="row">
				<legend class="col-form-label col-sm-2 pt-e">role</legend>
				<div class="col-auto">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="admin" value="admin" checked>
						<label class="form-check-label" for="boardsex1">
							Teacher
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="student" value="student">
						<label class="form-check-label" for="boardsex2">
							Student
						</label>
					</div>
				</div>
			</div>


			<div class="input-group mb-3">
  				<div class="input-group-prepend">
   					<label class="input-group-text" for="inputGroupSelect01">Department</label>
  				</div>
  				<select class="custom-select" id="department">
				  	<option value="" selected disabled hidden>Department</option>
    				<option value="資傳系">資傳系</option>
    				<option value="資工系">資工系</option>
    				<option value="資英系">資英系</option>
  				</select>
			</div>

			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">Password</span>
				</div>
 				<input type="password" class="form-control" placeholder="Enter Password"  aria-describedby="basic-addon1"name="passwd" required>
			</div>

			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">再次確認</span>
				</div>
 				<input type="password" class="form-control" placeholder="Enter Password" aria-describedby="basic-addon1"name="passwd_check" required>
			</div>

			<div class="form-group row">
				<div class="col-sm text-center" >
					<input name="action" type="hidden" id="action" value="add">
					<input class="btn btn-primary" type="submit" name="submit_info" id="submit_info" value="送出註冊">
					<input class="btn btn-primary" type="reset" name="button2" id="button2"value="重設資料">
					<input class="btn btn-primary" type="button" name="button3" id="button3" value="回上一頁"onClick="window.history.back();">
				</div>
			</div>
		</form>
	</div>
</body>

