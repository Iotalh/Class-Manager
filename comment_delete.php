<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
if (!isset($_SESSION['id'])) { // isset($_GET["class"]) &&
	echo "<script>alert('請先登入'); location.href = 'login.php';</script>";
}

if (isset($_GET["commentId"]) && isset($_GET["classId"])) {
	include("connectMysql.php");
	$id = $_GET["commentId"];
	$classId = $_GET["classId"];
	$sql_class_select = "SELECT title FROM class WHERE id=?";
	$class_stmt = $db_link->prepare($sql_class_select);
	$class_stmt->bind_param("i", $classId);
	if ($class_stmt->execute()) {
		$class_stmt->bind_result($classTitle);
		$class_stmt->fetch();
		$class_stmt->close();
	}

	$sql_select = "SELECT class, student, createTime, updateTime, content ,sweetScore, hwScore, learnScore FROM comment WHERE id=?";
	$stmt = $db_link->prepare($sql_select);
	$stmt->bind_param("i", $id);
	if ($stmt->execute()) {
		$stmt->bind_result($class, $student, $createTime, $updateTime, $content, $sweetScore, $hwScore, $learnScore);
		$stmt->fetch();
		$stmt->close();
	}
	if (isset($_POST["action"]) && ($_POST["action"] == "delete")) {
		$sql_delete = "DELETE FROM comment WHERE id =?";
		$stmt = $db_link->prepare($sql_delete);
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			$stmt->close();
			$db_link->close();
			echo "<script>alert('刪除成功'); location.href='comment_read.php?classId=".$classId."';</script>";
		} else {
			echo "<script>alert('刪除失敗');</script>";
			echo $stmt->error;
			die();
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
					<input type="text" name="title" id="title" class="form-control" placeholder="留言課程名稱" value="<? echo $classTitle; ?>" readonly>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect01">課程甜度</label>
					<select class="custom-select" id="sweetScore" name="sweetScore" readonly>
						<?php
						if (isset($sweetScore)) {
							echo "<option value='$sweetScore'>$sweetScore</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect02">作業壓力</label>
					<select class="custom-select" id="hwScore" name="hwScore" readonly>
						<?php
						if (isset($hwScore)) {
							echo "<option value='$hwScore'>$hwScore</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8 inputbox">
					<label for="inputGroupSelect03">學習狀況</label>
					<select class="custom-select" id="learnScore" name="learnScore" readonly>
						<?php
						if (isset($learnScore)) {
							echo "<option value='$learnScore'>$learnScore</option>";
						}
						?>

					</select>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<div class="col-8">
					<textarea class="form-control content inputbox" id="content" name="content" placeholder="輸入留言內容" readonly><?php
					echo $content;
					?></textarea>
				</div>
			</div>
			<div class="form-group row justify-content-md-center">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="action" id="action" value="delete">
				<input type="submit" value="確定刪除" class="btn btn-dark post-btns" name="btmSMT">
				<input type="button" value="回上一頁" class="btn btn-dark post-btns" name="btnBACK" onclick="window.history.back();">
			</div>

		</form>
	</div>
</body>

</html>