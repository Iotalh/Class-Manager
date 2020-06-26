<?php

function getSQLValue($value, $type)
{
	switch ($type) {
		case "text":
			$value = ($value != "") ? filter_var(
				$value,
				FILTER_SANITIZE_MAGIC_QUOTES
			) : "";
			break;
		case "int":
			$value = ($value != "") ? filter_var(
				$value,
				FILTER_SANITIZE_NUMBER_INT
			) : "";
			break;
		case "enum":
			$value = ($value != "") ? filter_var(
				$value,
				FILTER_VALIDATE_INT
			) : "";
			break;
	}
	return $value;
}

if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
	// session_start();
	// if ($_SESSION['id'] != null) {
		$id = $_SESSION['id'];
		require_once("connectMysql.php");
		$sql_insert = "INSERT INTO class_manager (id ,class ,student ,createTime ,updateTime ,content ,sweetScore, hwScore, learnScore) VALUES ($id, ?, ?, Now(), Now(), ?, ?, ?, ?)";
		$stmt = $db_link->prepare($sql_insert);
		$stmt->bind_param(
			"iisiii",
			getSQLValue($_POST["class"], "int"),
			getSQLValue($_POST["student"], "int"),
			getSQLValue($_POST["content"], "text"),
			getSQLValue($_POST["sweetScore"], "enum"),
			getSQLValue($_POST["hwScore"], "enum"),
			getSQLValue($_POST["learnScore"], "enum")
		);
		$stmt->execute();
		$stmt->close();
		$db_link->close(); //重新導向回到主畫面
		header("Location: index.php");
	//}
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
	<link rel="stylesheet" href="css/comment.css">
	<link rel="stylesheet" href="css/nav.css">
	<title>編輯留言</title>
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
				<div class="row nav-item justify-content-end">
					<a class="nav-link nav-btn" href="#">登出</a>
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid post text-white bg-dark">
		<h1 class="text-center">留言</h1>
		<form action="" method="post" name="formPost" onsubmit="return checkForm();">
			<div class="form-group row justify-content-md-center">
				<div class="col-8">
					<input type="text" name="title" id="title" class="form-control" placeholder="留言課程名稱">
					<!-- 利用 get 或 post 擷取 留言的課程 -->
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect01">課程甜度</label>
					<select class="custom-select" id="sweetScore">
						<option value="" selected disabled hidden></option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect02">作業壓力</label>
					<select class="custom-select" id="hwScore">
						<option value="" selected disabled hidden></option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect03">天文指數</label>
					<select class="custom-select" id="learnScore">
						<option value="" selected disabled hidden></option>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8">
					<textarea class="form-control content inputbox" placeholder="輸入留言內容"></textarea>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<input type="hidden" name="action" id="action" value="add">
				<input type="submit" value="送出留言" class="btn btn-dark post-btns" name="button" id="button">
				<input type="reset" value="重設資料" class="btn btn-dark post-btns" name="button2" id="button2">
				<input type="button" value="回上一頁" class="btn btn-dark post-btns" name="button3" id="button3" onclick="window.history.back();">
			</div>

		</form>
	</div>
</body>

</html>

<script>
	var $sweet = $("#sweetScore");
	var $hw = $("#hwScore");
	var $learn = $("#learnScore");

	$sweet.focusout(function() {
		if ($(this).val() != null) {
			$(this).removeClass("is-invalid");
		} else {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
			console.log("null");
		}
	});
</script>