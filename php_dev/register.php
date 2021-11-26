<?php
  require_once("init.php");
  require_once("function.php");
  $subjects_ids = [];
  $files = $_FILES;
  $subjects_ids = array_column($subjects, 'id');
  $errors = [];
  $user = $_POST;
  $rules = [
    'email' => function(){
      if(!validateEmail('email')){
        return "Введите корректный email";
      }
    },
    'password' => function(){
      $date = $_POST['date'];
      if(!is_date_valid($date)){
        return "Заполните это поле";
      }
      elseif(strtotime($date) > time()){
        return "Введите дату хотя бы следующего дня или позже";
      }
    },
    'photo' => function() {
      if(validateImage() != true){
        return validateImage();
      }
    },
    'name' => function(){
      if(!validateFilled('description')){
        return "Заполните это поле";
      }
    },
    'subject_id' => function($value) use ($subjects_ids){
        return validateSubjects($value, $subjects_ids);
    },
    'subject_help_id' => function($value) use ($subjects_ids){
      return validateSubjects($value, $subjects_ids);
    }
  ];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = return_validated_errors($rules, $errors);
    foreach ($files as $key => $value) {
      if (isset($rules[$key])) {
        $rule = $rules[$key];
        $result = $rule($value);
        if ($result !== null) {
          $errors[$key] = $result;
        }
      }
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)) {
    $file_name = $_FILES['photo']['name'];
    $uniq_url = uniqid();
    $file_path = 'uploads/' . $uniq_url . $file_name;
    $file_path_db = 'uploads/' . $uniq_url . $file_name;
    $file_upload_result = move_uploaded_file($_FILES['photo']['tmp_name'], $file_path);
    if (!$file_upload_result){
      die('Произошла ошибка загрузки фото!' . var_dump($_FILES));
    }
    $safe_email = mysqli_real_escape_string($connection, $user['email']);
    $sql = "SELECT id FROM users WHERE email = '$safe_email'";
    $res = mysqli_query($connection, $sql);
    if (mysqli_num_rows($res) > 0) {
      $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
    }
    else{
      $safe_name = mysqli_real_escape_string($connection, $_POST['name']);
      $safe_description = mysqli_real_escape_string($connection, $_POST['description']);
      $passwordHash = password_hash($user['password'], PASSWORD_DEFAULT);
      $new_user = [$safe_name, $_POST['date'], $safe_email, $safe_description, $passwordHash, $_POST['contacts'], ];
      $sql = "INSERT INTO `users`(`register_date`, `name`, `age`, `email`, `info`, `password`, `contacts`, `url`, `lock_id`) VALUES (NOW(), ?, ?, ?, ?, ?, ?, '$file_path_db', 0)";
      $stmt = db_get_prepare_stmt($connection, $sql, $new_user);
      $res = mysqli_stmt_execute($stmt);

      $user_id = intval(mysqli_insert_id($connection));

    foreach ($subjects as $s):
          $safe_id = intval($s['id']);
          if (isset($_POST[$s['id']]) ){
          $safe_id = intval($s['id']);
          $new_sub = [$user_id, $safe_id, NULL];
          $sql_main_subjects = "INSERT INTO `user_subjects` (`user_id`, `subject_id`, `text`) VALUES (?, ?, ?);";
//          $result_main_subjects = mysqli_query($connection, $sql_main_subjects);
          $stmt_sub = db_get_prepare_stmt($connection, $sql_main_subjects, $new_sub);
          $res = mysqli_stmt_execute($stmt_sub);
//          if (!$result_main_subjects) {
//            die("Ошибка добавления предметов с которыми хочет разобраться пользователь!" . var_dump($_POST));
//          }
    }
    endforeach;

    foreach ($subjects as $s):
        if (isset($_POST['help_' . $s['id']])){
          $safe_id = intval($s['id']);
//          $result_main_subjects = mysqli_query($connection, $sql_main_subjects);
          $new_help_sub = [$user_id, $safe_id, NULL];
          $sql_help_subjects = "INSERT INTO `user_help_subjects`(`user_id`, `subject_id`, `text`) VALUES (?, ?, ?);";
          $stmt_help_sub = db_get_prepare_stmt($connection, $sql_help_subjects, $new_help_sub);
          $res = mysqli_stmt_execute($stmt_help_sub);
        }
      endforeach;

      if ($res && empty($errors)) {
        header("Location: login.php");
        exit;
      }
    }
  }
  $errors = array_filter($errors);
  $content = include_template('register.php', ['subjects' => $subjects, 'connection' => $connection, 'rules' => $rules, 'errors' => $errors]);
  $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Регистрация', 'username' => $username, 'rules' => $rules]);
  print($layout_content);
?>
