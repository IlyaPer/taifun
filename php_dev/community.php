<?php
  require_once("init.php");
  require_once("function.php");
  $sql_users = "SELECT users.id, name, age, info, url FROM users;";
  $result_users = mysqli_query($connection, $sql_users);
  if (!$result_users) {
    exit;
  }
  $users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
  $content = include_template('community.php', ['users' => $users, 'connection' => $connection]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Сообщество', 'username' => $username, 'person_url' => $person_url, 'classname_index' => '', 'classname_comm' => 'main-menu__item--active']);
  print($layout_content);
  ?>
