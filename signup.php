<?
if(isset($_POST['submit_info'])){
	
	if(isset($_POST["passwd"]) && isset($_POST["passwd_check"]) && ($_POST["passwd"] == $_POST["passwd_check"])){
		require_once("connectMysql.php");
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
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="name" id="name" required>
			</div>


			<div class="input-group mb-3">
  				<div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">學號</span>
				</div>
 				<input type="text" class="form-control" placeholder="Enter Your Name" aria-label="Username" aria-describedby="basic-addon1"name="studentId" id="studentId" required>
			</div>



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
					</div>
				</div>
			</div>


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

