<?
session_start();
header("Connect-Type: text/html; charset = utf-8");
include("connectMysql.php");
$sql_query = "SELECT * FROM class ORDER BY id ASC";
$result = $db_link->query($sql_query);
if($_SESSION["userRole"] == NULL){
	$message = "請先登入";
	echo "<script>alert('$message'); 
	location.href = 'login.php';</script>";
}
if ($_SESSION["userRole"] != 'admin') { //測試是不是管理者
	$_SESSION["id"] = NULL;
	$_SESSION["userName"] = NULL;
	$_SESSION["userRole"] = NULL;
	$_SESSION["studentId"] = NULL;
	$_SESSION["department"] = NULL;
	$message = "錯誤!你不是管理者!!!!!即將回到首頁並登出";
	echo "<script>alert('$message'); 
	location.href = 'index.php';</script>";
}

if (isset($_POST['submit_info'])) { //測試該課程有沒有被建立過
	include("connectMysql.php");

	$post_title = $_POST["title"];

	$sql_query = "SELECT * FROM class ORDER BY title ";
	$result = $db_link->query($sql_query);

	$test1 = 1;
	while ($row_result = $result->fetch_assoc()) {
		if ($row_result['title'] == $post_title) {
			$test1 = 0;
			//echo "test1=false"."<br>";
		}
	}


	if ($test1 != 0) {
		$post_department = $_POST["department"];
		$post_semester = $_POST["semester"];
		$post_classId = $_POST["classId"];
		$post_credit = $_POST["credit"];
		$post_teacher = $_POST["teacher"];
		$post_link = $_POST["link"];

		//echo "status: department= ".$post_department." semester= ".$post_semester." classId= ". $post_classId.
		//" credit= ".$post_credit." title= ".$post_title." teacher= ".$post_teacher." link= ". $post_link."<br>";

		$sql_insert = "INSERT INTO class (department, semester ,classId ,credit ,title, teacher, link) 
		VALUES ('$post_department', '$post_semester', '$post_classId', '$post_credit', '$post_title', '$post_teacher', '$post_link')";
		mysqli_query($db_link, $sql_insert);
		$db_link->close();

		$message = "課程新增成功";
		echo "<script>alert('$message');</script>";
	} else {
		$message = "此課程已經新增過摟";
		echo "<script>alert('$message'); </script>";
	}
	echo "<script>location.href='classlist_update.php';</script>";

	$db_link->close();
}
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/nav.css">
	<title>新增課程</title>
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
						<a class="nav-link" href="index.php">課程清單<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<a class="btn btn-dark float-right" href="logout.php">登出</a>
			</div>
		</nav>
	</header>
	<div class="container-fluid post text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<h1 class="font-weight-bolder text-center"> 課程資料</h1>
				</div>
			</div>
			<form method="POST" name="formPost" action="" onSubmit="return checkForm();">

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">系所</label>
							</div>
							<select name="department" class="custom-select" required>
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
								<label class="input-group-text" for="inputGroupSelect01">學期</label>
							</div>
							<select name="semester" class="custom-select" required>
								<option value="" selected disabled hidden></option>
								<option value="1071">1071</option>
								<option value="1072">1072</option>
								<option value="1081">1081</option>
								<option value="1082">1082</option>
								<option value="1091">1091</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課號</span>
							</div>
							<input type="text" class="form-control" aria-label="classId" aria-describedby="basic-addon1" name="classId" id="classId" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">學分</span>
							</div>
							<input type="text" class="form-control" aria-label="credit" aria-describedby="basic-addon1" name="credit" id="credit" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="title" aria-describedby="basic-addon1" name="title" id="title" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">教師名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="teacher" aria-describedby="basic-addon1" name="teacher" id="teacher" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程簡介連結</span>
							</div>
							<input type="text" class="form-control" aria-label="link" aria-describedby="basic-addon1" name="link" id="link" required>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="form-group row">
							<div class="col-sm text-center">
								<input class="btn btn-dark btn-sm" type="submit" name="submit_info" id="submit_info" value="新增課程">
								<input class="btn btn-dark" type="reset" name="button2" value="重設資料">
								<input class="btn btn-dark" type="button" name="button3" value="回上一頁" onClick="window.history.back();">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>