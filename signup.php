<<<<<<< Updated upstream
=======
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
			font-family:"微軟正黑體";
		}
		.container {
			background: white;
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
	</style>
</head>
<body>
	<div class="container border border-secondary rounded">
		<div class="row">
			<div class="col-sm">
				<h1 class="font-weight-bolder text-center">課程評論管理系統</h1>
			</div>
		</div>
		<form method="POST" name = "formPost" action = "" onSubmit="return checkForm();">
			<div class= "form-group row">
				<label for="boardsubject" class="col-sm-2 col-form-label">ID</label>
				<div class="col-sm-10">
					<input type="text" placeholder="Enter Your Student ID" name="Id" required>
				</div>
			</div>
			<div class="row">
				<legend class="col-form-label col-sm-2 pt-e">role</legend>
				<div class="col-sm-10">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="admin" value="admin" checked>
						<label class="form-check-label" for="boardsex1">
							Teacher
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="boardsex" id="student" value="student">
						<label class="form-check-label" for="boardsex2">
							Student
						</label>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label for="boardmail" class="col-sm-2 col-form-label">郵件</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="boardmail" id="boardmail" placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<label for="boardweb" class="col-sm-2 col-form-label">web</label>
				<div class="col-sm-10">
					<input type="web" class="form-control" name="boardweb" id="boardweb" placeholder="Web">
				</div>
			</div>
			<div class="form-group row">
				<label for="boardcontent" class="col-sm-2 col-form-label">留言内容</label>
				<div class="col-sm-10">
					<textarea class="form-control" name="boardcontent" id="boardcontent" rows="3"></textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm text-right" >
					<input name="action" type="hidden" id="action" value="add">
					<input class="btn btn-primary" type="submit" name="button" id="button" value="送出留言">
					<input class="btn btn-primary" type="reset" name="button2" id="button2"value="重設資料">
					<input class="btn btn-primary" type="button" name="button3" id="button3" value="回上一頁"onClick="window.history.back();">
				</div>
			</div>
		</form>
	</div>
</body>

>>>>>>> Stashed changes
