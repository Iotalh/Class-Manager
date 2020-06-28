<?
session_start();
header("Connect-Type: text/html; charset = utf-8");
include("connectMysql.php");
$sql_query = "SELECT * FROM class ORDER BY id ASC";
$result = $db_link->query($sql_query);

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
	<title>課程評論管理系統</title>
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
				<?
				if ($_SESSION["userName"] == NULL) { ?>
					<a class="btn btn-dark float-right" href="login.php">登入</a>
					<a class="btn btn-dark float-right" href="signup.php">註冊</a>
				<? } else { ?>
					<a class="btn btn-dark float-right" href="#" hiddden><? echo $_SESSION["userName"] ?></a>
					<? if ($_SESSION["userRole"] != "student") { ?>
						<a class="btn btn-dark float-right" href="class_edit.php">編輯</a>
					<? } ?>
					<a class="btn btn-dark float-right" href="logout.php">登出</a>

				<? } ?>
			</div>
		</nav>
		<div class="container">
			<table class="table table-dark">
				<thead>
					<tr>
						<th scope="col">課號</th>
						<th scope="col">系所</th>
						<th scope="col">學期</th>
						<th scope="col">學分</th>
						<th scope="col">課程名稱</th>
						<th scope="col">導師</th>
						<th scope="col">課程頁面</th>
					</tr>
				</thead>
				<tbody>
					<? while ($row_RecClass = $result->fetch_assoc()) { ?>
						<tr>
							<th scope="row"><? echo nl2br($row_RecClass["classId"]); ?> </th>
							<td><? echo nl2br($row_RecClass["department"]); ?> </td>
							<td><? echo nl2br($row_RecClass["semester"]); ?> </td>
							<td><? echo nl2br($row_RecClass["credit"]); ?> </td>
							<td><a class="btn btn-dark btn-sm" href="comment_list.php?classId=<?php echo $row_RecClass["id"] ?>"><? echo nl2br($row_RecClass["title"]); ?></a></td>
							<td><? echo nl2br($row_RecClass["teacher"]); ?> </td>
							<td><a class="btn btn-dark btn-sm" href="<? echo $row_RecClass["link"] ?>">課程頁面</a></td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</header>
</body>

</html>