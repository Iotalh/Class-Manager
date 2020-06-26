<?
if (isset($_POST['login_info'])) {
	session_start();
	if (isset($_POST["studentID"]) && isset($_POST["passwd"])) {
		require_once("connectMysql.php");

		$post_studentID = $_POST["studentID"];
		$post_passwd = $_POST["passwd"];

		$sql_query = "SELECT * FROM account where studentID = '$post_studentID' ";
		$result = $db_link->query($sql_query);
		$row_result = $result->fetch_assoc();

		$studentID = $row_result['studentId'];
		$hashValue = $row_result["hashValue"];

		$db_link->close();
		$password_check = password_verify($post_passwd,  $hashValue);
		if (($studentID == $post_studentID) && ($password_check == 'true')) {
			$_SESSION["userName"] = $row_result['userName'];
			$_SESSION["userRole"] = $row_result['userRole'];
			$_SESSION["studentId"] = $row_result['studentId'];
			$_SESSION["department"] = $row_result['department'];
			$message = "登入成功";
				echo "<script>alert('$message'); 
				location.href = 'index.php';</script>";
		} else {
			$message = "StudentId or password error, please try again.";
			echo "<script>alert('$message'); 
			location.href = 'login.php';</script>";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<title>登入</title>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/nav.css">
	<title>登入</title>
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
			</div>
		</nav>
	</header>
	<div class="container-fluid post text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<h1 class="font-weight-bolder text-center">登入</h1>
				</div>
			</div>
			<form method="POST" name="loginMember" action="">
				<div class="form-group row justify-content-md-center">
					<div class="col-4">
						<label for="uname"><b>學號</b></label>
						<input name="studentID" class="form-control content" type="text" placeholder="Enter studentID"  required>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-4">
						<label for="psw"><b>Password</b></label>
						<input name="passwd" class="form-control content" type="password" placeholder="Enter Password" required>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-4">
						<button style="width: 100%;" class="btn btn-dark" type="submit" name="login_info">Login</button>
						<input style="width: 100%;" type="button" class= "btn btn-dark" value="SignUp" onclick="location.href='signup.php'"></input>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>