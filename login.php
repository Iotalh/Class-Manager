<?
if (isset($_POST['login_info'])) {
	session_start();
	if (isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "")) {
		if (isset($_POST["username"]) && isset($_POST["passwd"])) {
			require_once("connectMysql.php");
			$sql_query = "SELECT * FROM admin";
			$result = $db_link->query($sql_query);
			$row_result = $result->fetch_assoc();
			$username = $row_result["Id"];
			$hashValue = $row_result["hashValue"];
			$db_link->close();
			$password_check = password_verify($_POST["passwd"],  $hashValue);
			if (($username == $_POST["username"]) && ($password_check == 'true')) {
				$_SESSION["loginMember"] = $username;
				$message = "登入成功";
				echo "<script>alert('$message'); location.href = 'board.php';</script>";
			} else if ($username != $_POST["username"]) {
				$message = "username error, please relogin";
				echo "<script>alert('$message'); location.href = 'login.php';</script>";
			} else if ($passwd != $_POST["passwd"]) {
				$message = "password error, please relogin";
				echo "<script>alert('$message'); location.href = 'login.php';</script>";
			}
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
						<label for="uname"><b>Username</b></label>
						<input class="form-control content" type="text" placeholder="Enter ID" name="username" required>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-4">
						<label for="psw"><b>Password</b></label>
						<input class="form-control content" type="password" placeholder="Enter Password" name="passwd" required>
					</div>
				</div>
				<div class="form-group row justify-content-md-center">
					<div class="col-4">
						<button style="width: 100%;" class="btn btn-dark" type="submit" name="login_info">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>