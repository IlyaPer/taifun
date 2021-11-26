<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="img/icon.svg" type="img/svg+xml">
  <link rel="apple-touch-icon" href="img/apple.webp">
  <title><?= $title; ?></title>
</head>
<body class="main-body">
<header class="main-header">
  <h1 class="main-header__heading">СОЮЗ-ТАЙФУН</h1>
  <?php if($username !== null): ?>
  <a class="main-header__username" href="<?= $person_url ?>">
    <div class="main-header__profile">
      <h2 class="main-header__username"><a class="default" style="color:white;" href="logout.php">Выйти</a></h2>
      <a href="<?= $person_url ?>"><img class="main-header__photo" src="<?= $_SESSION['url']; ?>" alt="фото"></a>
    </div>
  </a>
  <?php else: ?>
  <div class="main-header__profile">
    <a href="login.php">Войти</a>
    <a href="register.php">Зарегистрироваться</a>
  </div>
  <?php endif; ?>
</header>
<section class="main-menu">
  <ul class="main-menu__list">
    <li class="main-menu__item <?= $classname_index; ?>"><a class="default" href="applications.php">ГЛАВНАЯ</a></li>
    <li class="main-menu__item <?= $classname_comm; ?>"><a class="default" href="community.php">ПОЛЬЗОВАТЕЛИ</a></li>
    <li class="main-menu__item"><a class="default" href="search.html">ЧАТ</a></li>
  </ul>
</section>
<?= $content; ?>
</body>
</html>
