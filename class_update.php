<?
include("connectMysql.php");
	if(isset($_POST['submit_info'])){
		$id = $_POST['id'];
		$department = $_POST['department'];

		$semester = $_POST['semester'];
		$classId = $_POST['classId'];
		$credit = $_POST['credit'];
		$title = $_POST['title'];
		$teacher = $_POST['teacher'];
		$link = $_POST['link'];
		echo "c".$id. $department. $semester. $classId. $credit. $title. $teacher. $link."    c"."<br>";

		$sql_query= "UPDATE class SET department = $department, semester = $semester, classId = $classId, credit = $credit, 
		title = $title, teacher = $teacher, link = $link where id = $id";

		mysqli_query($db_link,$sql_query);
		$db_link->close();

		$message = "課程資料更新成功!";
		echo "<script>alert('$message'); </script>";
		//echo "<script>location.href='class_edit.php';</script>";
	}else{
	$get_userid= $_GET["id"];
	$sql_select = "SELECT * FROM class WHERE id = $get_userid";
	$result = mysqli_query($db_link, $sql_select);
	$row_result = mysqli_fetch_assoc($result);

	$id = $row_result['id'];
	$department = $row_result['department'];
	$semester = $row_result['semester'];
	$classId = $row_result['classId'];
	$credit = $row_result['credit'];
	$title = $row_result['title'];
	$teacher = $row_result['teacher'];
	echo "c".$id. $department. $semester. $classId. $credit. $title. $teacher. $link."c"."<br>";
	$link = $row_result['link'];
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
	<title>更新課程資料</title>
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
						<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
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
							<select  name ="department" class="custom-select" >
							　	<option value="" selected disabled hidden><?php echo $department; ?></option>
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
							<select name ="semester" class="custom-select" >
							　	<option value="" selected disabled hidden><?php echo$semester; ?></option>
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
							<input type="text" class="form-control" aria-label="classId" aria-describedby="basic-addon1" name="classId" id="classId" value = "<?echo $classId?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">時數</span>
							</div>
							<input type="text" class="form-control" aria-label="credit" aria-describedby="basic-addon1" name="credit" id="credit" value = "<?echo $credit?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="title" aria-describedby="basic-addon1" name="title" id="title" value = "<?echo $title?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">導師名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="teacher" aria-describedby="basic-addon1" name="teacher" id="teacher" value = "<?echo $teacher?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程簡介連結</span>
							</div>
							<input type="text" class="form-control" aria-label="link" aria-describedby="basic-addon1" name="link" id="link" value = "<?echo $link?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="form-group row">
							<div class="col-sm text-center">
								<input name="action" type="hidden" id="action" value="add">
								<input class="btn btn-dark" type="submit" name="submit_info" id="submit_info" value="確認修改">
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