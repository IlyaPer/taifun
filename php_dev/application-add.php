<?php
  require_once("init.php");
  require_once("function.php");

    $new_info = [$_GET['title'], $_GET['content'], $_GET['url'], $user_id, $_GET['subject']];
    $sql = "INSERT INTO applications (date_creation, title, content, url, user_id, subject_id) VALUES (NOW(), ?, ?, ?, ?, ?);";
    $stmt = db_get_prepare_stmt($connection, $sql, $new_info);
    $res = mysqli_stmt_execute($stmt);
    if($res){
      header("Location: applications.php");
    }
    else{
      print(mysqli_error($connection));
    }
