<?
if (isset($_POST['submit_info'])) {
	include("connectMysql.php");

	$post_studentId = $_POST["studentId"];
	echo "post_studentId= ".$post_studentId."<br>";
	$sql_query = "SELECT * FROM account ORDER BY id ";
	$result = $db_link->query($sql_query);

	$test = false;
	while($row_result = $result->fetch_assoc())
	{
		if($row_result['studentId'] == $post_studentId)
		{
			echo "ccc";
			$test = true;
		}
	}

	if($test != true){

		if (isset($_POST["passwd"]) && isset($_POST["passwd_check"]) && ($_POST["passwd"] == $_POST["passwd_check"])) {

			$post_role = $_POST['role'];
			$post_name = $_POST['name'];
			$post_department = $_POST['department'];

			$cal_hashValue = password_hash($_POST["passwd"], PASSWORD_BCRYPT);

			//echo "status: id= ".$id_num." role= ".$post_role." studentID= ". $post_studentId." hash= ".$cal_hashValue." name= ".$post_name.
			//" department= ".$post_department."<br>";

		    $sql_insert = "INSERT INTO account (userRole, studentId ,hashValue ,userName ,department) VALUES ('$post_role', '$post_studentId',
			 '$cal_hashValue', '$post_name', '$post_department')";
			mysqli_query($db_link, $sql_insert);
			$db_link->close();

			$message="註冊成功";
			echo "<script>alert('$message');
			//location.href='login.php';</script>";

		}
		else{
			$message="輸入的兩次密碼不符，請重新輸入";
			echo "<script>alert('$message'); </script>";
		}
	}else{
		$message="此學號已經註冊過摟";
		echo "<script>alert('$message'); </script>";

	}
	
	//echo "<script>location.href='signup.php';</script>";

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
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>

				</ul>

				</ul>
			</div>
		</nav>
	</header>
	<div class="container-fluid post text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<h1 class="font-weight-bolder text-center">註冊</h1>
				</div>
			</div>
			<form method="POST" name="formPost" action="" onSubmit="return checkForm();">
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">姓名</span>
							</div>
							<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="name" id="name">
						</div>
					</div>
				</div>


				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">學號</span>
							</div>
							<input type="text" name="studentId" class="form-control" aria-label="studentId" aria-describedby="basic-addon1" id="studentId">
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">身分</label>
							</div>
							<select  name ="role" class="custom-select" >
								<option value="" selected disabled hidden></option>
								<option value="admin">Teacher</option>
								<option value="student">Student</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">註冊</label>
							</div>
							<select name ="department" class="custom-select" >
								<option value="" selected disabled hidden></option>
								<option value="資傳系">資傳系</option>
								<option value="資工系">資工系</option>
								<option value="資訊英專">資訊英專</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Password</span>
							</div>
							<input type="password" class="form-control" aria-describedby="basic-addon1" name="passwd" required>
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
								<input class="btn btn-dark" type="submit" name="submit_info" id="submit_info" value="送出註冊">
								<input class="btn btn-dark" type="reset" name="button2" id="button2" value="重設資料">
								<input class="btn btn-dark" type="button" name="button3" id="button3" value="回上一頁" onClick="window.history.back();">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>