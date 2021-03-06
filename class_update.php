<?
session_start();
include("connectMysql.php");

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
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$sql_select = "SELECT department, semester, classId, credit, title, teacher, link FROM class WHERE id=?";
	$stmt = $db_link->prepare($sql_select);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($department, $semester, $classId, $credit, $title, $teacher, $link);
	$stmt->fetch();
	$stmt->close();

	if (isset($_POST['action']) && $_POST["action"] == "update") {
		$sql_query = "UPDATE class SET department=?, semester=?, classId=?, credit=?, title=?, teacher=?, link=? where id=?";
		$stmt = $db_link->prepare($sql_query);
		$stmt->bind_param('sssisssi', $_POST['department'], $_POST['semester'], $_POST['classId'], $_POST['credit'], $_POST['title'], $_POST['teacher'], $_POST['link'], $_POST['id']);
		if ($stmt->execute()) {
			$stmt->close();
			$db_link->close();
			$message = "課程資料更新成功!";
			echo "<script>alert('$message'); location.href='classlist_update.php';</script>";
			//echo "<script>location.href='classlist_update.php';</script>";
		} else {
			$message = "課程資料更新失敗!";
			echo "<script>alert('$message'); location.href='classlist_update.php';</script>";
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
						<a class="nav-link" href="index.php">課程清單<span class="sr-only">(current)</span></a>
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
							<select name="department" class="custom-select">
								<option value="<? echo $department; ?>"><? echo $department; ?></option>
								<? if ($department != "資傳系") { ?>
									<option value="資傳系">資傳系</option>
								<? } ?>
								<? if ($department != "資工系") { ?>
									<option value="資工系">資工系</option>
								<? } ?>
								<? if ($department != "資訊英專") { ?>
									<option value="資訊英專">資訊英專</option>
								<? } ?>
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
							<select name="semester" class="custom-select">
								<option value="<? echo $semester; ?>"><? echo $semester; ?></option>
								<? if ($semester != "1071") { ?>
									<option value="1071">1071</option>
								<? } ?>
								<? if ($semester != "1072") { ?>
									<option value="1072">1072</option>
								<? } ?>
								<? if ($semester != "1081") { ?>
									<option value="1081">1081</option>
								<? } ?>
								<? if ($semester != "1082") { ?>
									<option value="1082">1082</option>
								<? } ?>
								<? if ($semester != "1091") { ?>
									<option value="1091">1091</option>
								<? } ?>
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
							<input type="text" class="form-control" aria-label="classId" aria-describedby="basic-addon1" name="classId" id="classId" value="<? echo $classId ?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">學分</span>
							</div>
							<input type="text" class="form-control" aria-label="credit" aria-describedby="basic-addon1" name="credit" id="credit" value="<? echo $credit ?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="title" aria-describedby="basic-addon1" name="title" id="title" value="<? echo $title ?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">教師名稱</span>
							</div>
							<input type="text" class="form-control" aria-label="teacher" aria-describedby="basic-addon1" name="teacher" id="teacher" value="<? echo $teacher ?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">課程簡介連結</span>
							</div>
							<input type="text" class="form-control" aria-label="link" aria-describedby="basic-addon1" name="link" id="link" value="<? echo $link ?>">
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<div class="form-group row">
							<div class="col-sm text-center">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<input name="action" type="hidden" id="action" value="update">
								<input class="btn btn-dark" type="submit" name="submit_info" value="確認修改">
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