<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connectMysql.php");
if (isset($_GET["classId"])) {
    $classId = $_GET["classId"];
    $sql_select = "SELECT id, student, createTime, updateTime, content ,sweetScore, hwScore, learnScore FROM comment WHERE class={$classId} ORDER BY createTime ASC";
    $comments = $db_link->query($sql_select);

    session_start();


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
                            <a class="nav-link" href="index.php">課程清單 <span class="sr-only">(current)</span></a>
                        </li>

                    </ul>
                    <div class="row nav-item justify-content-end">
                        <a class="nav-link nav-btn" href="comment_create.php?classId=<? echo $classId; ?>">新增留言</a>
                        <a class="nav-link nav-btn" href="logout.php">登出</a>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container comment-list text-white bg-dark">
            <?php while ($row = $comments->fetch_assoc()) {
            ?>
                <div class="row">
                    <div class="col-sm">
                        <div class="card boder-light mb-3">
                            <div class="card-header d-flex">
                                <div class="mr-auto">
                                    <span class="badge badge-pill badge-secondary"><? echo $row["id"] ?></span>
                                    <?
                                    if (isset($row["sweetScore"])) {
                                        $sweetScore = $row["sweetScore"];
                                        if ($sweetScore <= 10 && $sweetScore > 6) {
                                            echo "<span class='badge badge-pill badge-success sweetScore'>課程甜度：$sweetScore</span>";
                                        } else if ($sweetScore <= 6 && $sweetScore > 3) {
                                            echo "<span class='badge badge-pill badge-warning sweetScore'>課程甜度：$sweetScore</span>";
                                        } else {
                                            echo "<span class='badge badge-pill badge-danger sweetScore'>課程甜度：$sweetScore</span>";
                                        }
                                    }
                                    if (isset($row["hwScore"])) {
                                        $hwScore = $row["hwScore"];
                                        if ($hwScore <= 10 && $hwScore > 6) {
                                            echo "<span class='badge badge-pill badge-success hwScore'>課業壓力：$hwScore</span>";
                                        } else if ($hwScore <= 6 && $hwScore > 3) {
                                            echo "<span class='badge badge-pill badge-warning hwScore'>課業壓力：$hwScore</span>";
                                        } else {
                                            echo "<span class='badge badge-pill badge-danger hwScore'>課業壓力：$hwScore</span>";
                                        }
                                    }
                                    if (isset($row["learnScore"])) {
                                        $learnScore = $row["learnScore"];
                                        if ($learnScore <= 10 && $learnScore > 6) {
                                            echo "<span class='badge badge-pill badge-success learnScore'>天文指數：$learnScore</span>";
                                        } else if ($learnScore <= 6 && $learnScore > 3) {
                                            echo "<span class='badge badge-pill badge-warning learnScore'>天文指數：$learnScore</span>";
                                        } else {
                                            echo "<span class='badge badge-pill badge-danger learnScore'>天文指數：$learnScore</span>";
                                        }
                                    }
                                    $sql_user = "SELECT userName FROM account WHERE id=?";

                                    $user = $db_link->prepare($sql_user);
                                    $user->bind_param("i", $row["student"]);
                                    if ($user->execute()) {
                                        $user->bind_result($userName);
                                        $user->fetch();
                                        $user->close();
                                    }

                                    if (isset($userName)) {
                                        if ($userName == $_SESSION["userName"] || $_SESSION["userRole"] == "admin") {
                                            echo "<span class='badge badge-light'>" . $userName . "</span>";
                                        }
                                    } else {
                                        echo "<span class='badge badge-light'>某個也有修課的同學</span>";
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?
                                    if (isset($_SESSION["id"]) && isset($row["student"])) {
                                        if ($row["student"] == $_SESSION["id"] || $_SESSION["userRole"] == "admin") {
                                            echo "<a class='btn btn-light btn-sm mr-auto justify-content-end' href='comment_update.php?classId=" . $classId . "&commentId=" . $row["id"] . "'>修改</a>";
                                            echo "<a class='btn btn-light btn-sm mr-auto justify-content-end' href='comment_delete.php?classId=" . $classId . "&commentId=" . $row["id"] . "'>刪除</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-body text-secondary">
                                <p class="card-text">
                                    <? echo nl2br($row["content"]) ?>
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="d-flex flex-row-reverse">
                                    <span class="justify-content-end badge badge-pill badge-light">
                                        <? echo $row["createTime"] ?></span>
                                    <span class="justify-content-end badge badge-pill badge-light">
                                        <? echo $row["updateTime"] ?></span>
                                </div>
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

<?
}
?>