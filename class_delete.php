<?php

    $userId = $_GET['id'];
    include ('connectMysql.php');
    $sql_query = "DELETE FROM class WHERE id = $userId";
    mysqli_query($db_link,$sql_query);
    $db_link->close();

	$message = "刪除成功~";
	echo "<script>alert('$message'); 
	location.href = 'class_read.php';</script>";
?>