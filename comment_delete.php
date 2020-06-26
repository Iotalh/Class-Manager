<?php

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
	<link rel="stylesheet" href="css/comment.css">
	<link rel="stylesheet" href="css/nav.css">
	<title>刪除留言</title>
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
	<div class="container-fluid">
		<div class="post text-white bg-dark">
			<h1 class="text-center">留言</h1>
			<form action="" method="post" name="formPost" onsubmit="return checkForm();">
				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<input type="text" name="boardsubject" id="boardsubject" class="form-control" placeholder="輸入留言標題">
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8">
						<textarea class="form-control content" placeholder="輸入留言內容"></textarea>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<input type="hidden" name="action" id="action" value="add">
					<input type="submit" value="刪除留言" class="btn btn-dark post-btns" name="button" id="button">
					<input type="button" value="回上一頁" class="btn btn-dark post-btns" name="button3" id="button3" onclick="window.history.back();">
				</div>
			</form>
		</div>
	</div>
</body>

</html>