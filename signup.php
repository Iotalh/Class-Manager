<?
if(isset($_POST['submit_info'])){
	
	if(isset($_POST["passwd"]) && isset($_POST["passwd_check"]) && ($_POST["passwd"] == $_POST["passwd_check"])){
		require_once("connectMysql.php");
<<<<<<< HEAD
        //$sql_insert = "INSERT INTO account (Id ,role, studentId ,hashValue ,name ,department) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db_link->prepare($sql_insert);

		$get_id_num_sql = "SELECT * FROM account ORDER BY Id DESC LIMIT 0 , 1";
		$all_id_num = $db_link->prepare($get_id_num_sql);
		$id_num = $all_id_num -> num_rows;
		$id_num = $id_num + 1;
		echo "id_num= ". $id_num . "<br>";
		$cal_hashValue = password_hash($_POST["passwd"], PASSWORD_BCRYPT);
		echo "cal_hashValue= ". $cal_hashValue . "<br>";

		echo "data= ".$_POST["role"].$_POST["studentId"].$cal_hashValue. $_POST["name"].$_POST["department"];
        $sql_insert = "INSERT INTO account (Id ,role, studentId ,hashValue ,name ,department) VALUES ($id_num, 
		$_POST["role"], 
		$_POST["studentId"], 
		$cal_hashValue, 
		$_POST["name"], 
		$_POST["department"]);

		$result = mysql_query($sql_insert, $stmt) or die(mysql_error());

		$stmt->execute();
		$stmt->close();
		$db_link->close();//重新導向回到主畫面


		$message="註冊成功";
		echo "<script>alert('$message'); location.href='login.php';</script>";

	}
	else{
		$message="輸入的兩次密碼不符，請重新輸入";
		echo "<script>alert('$message'); </script>";
=======
		$sql_query = "SELECT * FROM account";
		$result = $db_link->query($sql_query);
		$row_result=$result->fetch_assoc();
		$username = $row_result["Id"];
		$hashValue = $row_result["hashValue"];
        $db_link->close();
        $password_check = password_verify ( $_POST["passwd"] ,  $hashValue);
		if(($username==$_POST["username"]) && ($password_check == 'true')){
			$_SESSION["loginMember"]=$username;
			$message="登入成功";
			echo "<script>alert('$message'); location.href = 'board.php';</script>";
		}else if($username!=$_POST["username"]){
			$message="username error, please relogin";
			echo "<script>alert('$message'); location.href = 'login.php';</script>";
		}else if($passwd!=$_POST["passwd"]){
			$message="password error, please relogin";
			echo "<script>alert('$message'); location.href = 'login.php';</script>";
		}
	}
	else{
		$message="輸入的兩次密碼不符，請重新輸入";
		echo "<script>alert('$message'); location.href = 'login.php';</script>";
>>>>>>> master
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
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/nav.css">
	<title>註冊</title>
</head>

<body>
	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<a class="navbar-brand" href="index.php">課程評論管理系統</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>

<<<<<<< HEAD
			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">姓名</span>
				</div>
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="name" id="name" required>
=======
				</ul>
>>>>>>> master
			</div>
		</nav>
	</header>
	<div class="container-fluid post text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<h1 class="font-weight-bolder text-center">註冊</h1>
				</div>
<<<<<<< HEAD
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="studentId" id="studentId" required>
=======
>>>>>>> master
			</div>
			<form method="POST" name="formPost" action="" onSubmit="return checkForm();">
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">姓名</span>
							</div>
							<input type="text" class="form-control" aria-label="Username"
								aria-describedby="basic-addon1" name="name" id="name">
						</div>
					</div>
				</div>


<<<<<<< HEAD

			<div class="row">
				<legend class="col-form-label col-sm-2 pt-e">role</legend>
				<div class="col-auto">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="0" value="admin" checked>
						<label class="form-check-label" for="boardsex1">
							Teacher
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="1" value="student">
						<label class="form-check-label" for="boardsex2">
							Student
						</label>
=======
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">學號</span>
							</div>
							<input type="text" class="form-control" aria-label="Username"
								aria-describedby="basic-addon1" name="Id" id="Id">
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">Role</label>
							</div>
							<select class="custom-select" id="department">
								<option value="" selected disabled hidden></option>
								<option name="boardsex" id="admin" value="admin">Teacher</option>
								<option name="boardsex" id="student" value="student">Student</option>
							</select>
						</div>
>>>>>>> master
					</div>
				</div>

<<<<<<< HEAD

			<div class="input-group mb-3">
  				<div class="input-group-prepend">
   					<label class="input-group-text" for="inputGroupSelect01">Department</label>
  				</div>
  				<select class="custom-select" id="department" required>
				  	<option value="" selected disabled hidden>Department</option>
    				<option value="0">資傳系</option>
    				<option value="1">資工系</option>
    				<option value="2">資訊英專</option>
  				</select>
			</div>

			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">Password</span>
=======
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">Department</label>
							</div>
							<select class="custom-select" id="department">
								<option value="" selected disabled hidden></option>
								<option value="資傳系">資傳系</option>
								<option value="資工系">資工系</option>
								<option value="資英系">資英系</option>
							</select>
						</div>
					</div>
>>>>>>> master
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Password</span>
							</div>
							<input type="password" class="form-control" aria-describedby="basic-addon1" name="passwd"
								required>
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">再次確認</span>
							</div>
							<input type="password" class="form-control" aria-describedby="basic-addon1" name="passwd_check" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="form-group row">
							<div class="col-sm text-center">
								<input name="action" type="hidden" id="action" value="add">
								<input class="btn btn-dark" type="submit" name="submit_info" id="submit_info"
									value="送出註冊">
								<input class="btn btn-dark" type="reset" name="button2" id="button2" value="重設資料">
								<input class="btn btn-dark" type="button" name="button3" id="button3" value="回上一頁"
									onClick="window.history.back();">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>