<?php
// if (isset($_GET["class"])) {
header("Content-Type: text/html; charset=utf-8");
require_once("connectMysql.php");
// $class = $_GET["class"];
$sql_select = "SELECT id, class, student, createTime, updateTime, content ,sweetScore, hwScore, learnScore FROM comment ORDER BY createTime ASC";
$comments = $db_link->query($sql_select);
$sql_user = "SELECT id, userName FROM account";
$user = $db_link->query($sql_user);
// session_start();
// if($_SESSION[""])
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
    <title>留言列表</title>
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

    <div class="container comment-list text-white bg-dark">
        <?php while ($row = $comments->fetch_assoc()) {
            $userdata = $user->fetch_assoc();
        ?>
            <div class="row">
                <div class="col-sm">
                    <div class="card boder-primary mb-3">
                        <div class="card-header">
                            <span class="badge badge-pill badge-secondary">
                                <? echo $row["id"] ?></span>
                            <?
                            if (isset($userdata["userName"])) {
                                echo "<span class='badge badge-primary'>" . $userdata["userName"] . "</span>";
                            }else{
                                echo "<span class='badge badge-primary'>匿名ㄉ朋友</span>";
                            }
                            ?>

                            <span class="badge badge-pill badge-secondary">
                                <? echo $row["createTime"] ?></span>
                            <span class="badge badge-pill badge-secondary">
                                <? echo $row["updateTime"] ?></span>
                        </div>
                        <div class="card-body text-secondary">
                            <p class="card-text">
                                <? echo nl2br($row["content"]) ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        <?
        }
        ?>
    </div>
</body>

</html>
<?php
// }
?>