<?php
    require_once("init.php");
    if(!isset($_SESSION['user_id'])){
      header('Location: login.php');
      exit;
    }
    $id = intval($_GET['id']) ?? NULL;
    if ($id === NULL or ctype_digit($_GET['id']) === false) {
      header("Location: pages/404.html");
      exit;
    }
    require_once("function.php");
    if ($id !== intval($_SESSION['user_id'])){
      $my_account = 0;
    }
    else {
      $my_account = 1;
    }
    $sql_user = "SELECT users.id, name, age, email, contacts, info, users.url, lock_id, user_subjects.user_id AS sub_user_id, user_subjects.subject_id AS subject_id, user_help_subjects.user_id AS user_id_help, user_help_subjects.subject_id AS subject_id_help, subjects.id, subjects.title
    FROM users JOIN user_subjects ON users.id = user_subjects.user_id JOIN user_help_subjects JOIN subjects ON user_subjects.subject_id = subjects.id
    WHERE users.id = '$id';";
    $result_user = mysqli_query($connection, $sql_user);
    if (!$result_user) {
      exit;
    }
    $user = mysqli_fetch_assoc($result_user);
    $sql_user_subject = "SELECT subjects.id, subjects.title AS title, user_subjects.user_id AS sub_user_id, user_subjects.text, user_subjects.subject_id AS subject_id FROM subjects JOIN user_subjects ON subjects.id = user_subjects.subject_id WHERE user_subjects.user_id = '$id';";
    $result_user_subject = mysqli_query($connection, $sql_user_subject);
    if (!$result_user_subject) {
      exit;
    }
    $user_subjects = mysqli_fetch_all($result_user_subject, MYSQLI_ASSOC);
    $sql_user_help_subjects = "SELECT subjects.id, subjects.title AS title, user_help_subjects.user_id, user_help_subjects.text, user_help_subjects.subject_id FROM subjects JOIN user_help_subjects ON subjects.id = user_help_subjects.subject_id WHERE user_help_subjects.user_id = '$id';";
    $result_user_help_subjects = mysqli_query($connection, $sql_user_help_subjects);
    if (!$result_user_help_subjects) {
      exit;
    }
    $user_help_subjects = mysqli_fetch_all($result_user_help_subjects, MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $safe_email = mysqli_real_escape_string($connection, $user['email']);
      $new_user = [3, $user_subjects['id'], $_POST[$user_subjects['id']], ];
      $sql = "INSERT INTO `user_subjects`(`user_id`, `subject_id`, `text`) VALUES (?, ?, ?)";
      $stmt = db_get_prepare_stmt($connection, $sql, $new_user);
      $res = mysqli_stmt_execute($stmt);
    }
    $content = include_template('user.php', ['user' => $user, 'connection' => $connection, 'user_subjects' => $user_subjects, 'user_help_subjects' => $user_help_subjects, 'subjects' => $subjects, 'my_account' => $my_account]);
    $layout_content = include_template('layout.php', ['content' => $content, 'title' => 'Профиль', 'username' => $username, 'person_url' => $person_url]);
    print($layout_content);
?>
