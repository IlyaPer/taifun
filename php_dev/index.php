<?php
  require_once("init.php");
  require_once("function.php");
  $content = include_template('index.php', ['connection' => $connection]);
  print($content);
?>
