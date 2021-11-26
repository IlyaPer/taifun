<?php
  require_once("init.php");
  require_once("function.php");

  $sql_applications = "SELECT `date_creation`, applications.title, `content`, applications.url, `user_id`, `subject_id`, users.id, subjects.id, subjects.title AS main_title, subjects.color_hex_id FROM `applications` JOIN users ON user_id = users.id JOIN subjects ON subjects.id = subject_id;";
  $result_lots = mysqli_query($connection, $sql_applications);
  if (!$result_lots) {
    exit;
  }
  $applications = mysqli_fetch_all($result_lots, MYSQLI_ASSOC);

  $sql_subjects = "SELECT id, title, color_hex_id, url FROM subjects;";
  $result_subjects = mysqli_query($connection, $sql_subjects);
  if (!$result_subjects) {
    exit;
  }
  $subjects = mysqli_fetch_all($result_subjects, MYSQLI_ASSOC);
  $content = include_template('applications.php', ['applications' => $applications, 'connection' => $connection, 'subjects' => $subjects]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Союз-тайфун', 'username' => $username, 'subjects' => $subjects]);
  print($layout_content);
  ?>
