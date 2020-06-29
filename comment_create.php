<?php
header("Content-Type: text/html; charset=utf-8");

function getSQLValue($value, $type)
{
	switch ($type) {
		case "string":
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
		case "email":
			$value = ($value != "") ? filter_var(
				$value,
				FILTER_VALIDATE_EMAIL
			) : "";
			break;
		case "url":
			$value = ($value != "") ? filter_var(
				$value,
				FILTER_VALIDATE_URL
			) : "";
			break;
	}
	return $value;
}
session_start();

if (!isset($_SESSION["id"])) { // isset($_GET["class"]) &&
	echo "<script>alert('請先登入'); location.href = 'login.php';</script>";
}
if (isset($_GET["classId"])) {
	include("connectMysql.php");
	$id = $_GET["classId"];
	$student = $_SESSION["id"];
	$sql_class_select = "SELECT title FROM class WHERE id=?";
	$class_stmt = $db_link->prepare($sql_class_select);
	$class_stmt->bind_param("i", $id);
	if ($class_stmt->execute()) {
		$class_stmt->bind_result($classTitle);
		$class_stmt->fetch();
		$class_stmt->close();
	}
	if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
		if (isset($_POST["content"]) && isset($_POST["sweetScore"]) && isset($_POST["hwScore"]) && isset($_POST["learnScore"])) {
			$content = $_POST["content"];
			$sweetScore = $_POST["sweetScore"];
			$hwScore = $_POST["hwScore"];
			$learnScore = $_POST["learnScore"];
			if ($content == "" || $sweetScore == "" || $hwScore == "" || $learnScore == "") {
				echo "<script>alert('尚有欄位沒有填寫'); </script>";
			} else {
				$sql_insert = "INSERT INTO comment(class, student, createTime, updateTime, content ,sweetScore, hwScore, learnScore) VALUES (?, ?, now(), now(), ?, ?, ?, ?)";
				$class = $_POST["id"];
				$stmt = $db_link->prepare($sql_insert);
				$stmt->bind_param("iissss", $class, $student, $content, $sweetScore, $hwScore, $learnScore);
				if ($stmt->execute()) {
					$stmt->close();
					$db_link->close();
					// echo "新增成功";
					echo "<script>alert('新增成功'); location.href='comment_read.php?classId=$class';</script>";
				} else {
					echo "<script>alert('新增失敗'); location.href='comment_read.php?classId=$class';</script>";
					echo $stmt->error;
					die();
				}
			}
		}else{
			echo "<script>alert('尚有欄位沒有填寫'); </script>";
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
	<link rel="stylesheet" href="css/comment.css">
	<link rel="stylesheet" href="css/nav.css">
	<title>新增評論</title>
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
						<a class="nav-link" href="index.php">課程清單 <span class="sr-only">(current)</span></a>
					</li>

				</ul>
				<div class="row nav-item justify-content-end">
					<a class="nav-link nav-btn" href="logout.php">登出</a>
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid post text-white bg-dark">
		<h1 class="text-center">評論</h1>
		<form action="" method="post" name="formPost" onsubmit="return checkForm();">
			<div class="form-group row justify-content-md-center">
				<div class="col-8">
					<input type="text" name="title" id="title" class="form-control" placeholder="評論課程名稱" value="<? echo $classTitle; ?>" readonly>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect01">課程甜度</label>
					<select class="custom-select" id="sweetScore" name="sweetScore" require>
						<?php
						if (isset($sweetScore)) {
							echo "<option value='$sweetScore'>$sweetScore</option>";
						} else {
							echo "<option value='' selected disabled hidden></option>";
						}
						for ($i = 0; $i <= 10; $i++) {
							echo "<option value='$i'>$i</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect02">作業壓力</label>
					<select class="custom-select" id="hwScore" name="hwScore" require>
						<?php
						if (isset($hwScore)) {
							echo "<option value='$hwScore'>$hwScore</option>";
						} else {
							echo "<option value='' selected disabled hidden></option>";
						}
						for ($i = 0; $i <= 10; $i++) {
							echo "<option value='$i'>$i</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect03">學習狀況</label>
					<select class="custom-select" id="learnScore" name="learnScore" require>
						<?php
						if (isset($learnScore)) {
							echo "<option value='$learnScore'>$learnScore</option>";
						} else {
							echo "<option value='' selected disabled hidden></option>";
						}
						for ($i = 0; $i <= 10; $i++) {
							echo "<option value='$i'>$i</option>";
						}
						?>

					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8">
					<textarea class="form-control content inputbox" id="content" name="content" placeholder="輸入評論內容" require><?php
																																if (isset($content)) {
																																	echo $content;
																																}
																																?></textarea>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="action" id="action" value="add">
				<input type="submit" value="送出評論" class="btn btn-dark post-btns" name="button" id="button">
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
	var $content = $("#content");
	$sweet.focusout(function() {
		if ($(this).val() != null) {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid");
		} else {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
		}
	});
	$hw.focusout(function() {
		if ($(this).val() != null) {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid");
		} else {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
		}
	});
	$learn.focusout(function() {
		if ($(this).val() != null) {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid");
		} else {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
		}
	});
	$content.focusout(function() {
		if ($(this).val() != "") {
			$(this).removeClass("is-invalid");
			$(this).addClass("is-valid");
		} else {
			$(this).addClass("is-invalid");
			$(this).removeClass("is-valid");
		}
	});
</script>