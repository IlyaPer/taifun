<form class="registration-form" method="post" enctype="multipart/form-data" action="">
  <div class="registration-form__container">
    <label for="name">
      Ваше имя
    </label>
    <input class="registration-form__input" type="text" name="name" id="name" value="<?= getPostVal('name') ?>">
    <?php if(isset($errors['name'])){
      print("Error/n");
    } ?>
    <label for="email">
      Ваш email
    </label>
    <input class="registration-form__input" type="email" name="email" id="email" value="<?= getPostVal('email') ?>">
    <?php if(isset($errors['email'])){
      print($errors['email']);
    } ?>
  </div>
  <label for="password">
    Придумайте пароль:
  </label>
  <input class="registration-form__input" type="password" name="password" id="password" value="<?= getPostVal('password') ?>">
  <?php if(isset($errors['email'])){
    print($errors['email']);
  } ?>
  </div>
  <div class="registration-form__container">
    <label for="date">
      Дата рождения
    </label>
    <input class="registration-form__input" type="date" name="date" id="date" value="<?= getPostVal('date') ?>">
    <?php if(isset($errors['date'])){
      print($errors['date']);
    } ?>
  </div>
  <div class="registration-form__container">
    <label for="photo">
      Фото профиля:
    </label>
    <input type="file" value="Выбрать фото" id="photo" name="photo">
    <?php if(isset($errors['photo'])){
      print($errors['photo']);
      var_dump(validateImage());
    } ?>
  </div class="registration-form__container">
  <div class="registration-form__container v__container--description">
    <label for="description">
      Как с вами могут связаться другие пользователи?
    </label>
    <textarea class="registration-form__textarea" name="contacts" id="contacts" placeholder="Например, Skype, Telegram или электронная почта"><?= getPostVal('description') ?></textarea>
    <?php if(isset($errors['contacts'])){
      print("Error/n");
    } ?>
  </div>
  <div class="registration-form__container v__container--description">
    <label for="description">
      Расскажите о себе
    </label>
    <textarea class="registration-form__textarea" name="description" id="description" placeholder="Чем подробнее будет ваше описание, тем больше людей захотят с Вами сотрудничать!"><?= getPostVal('description') ?></textarea>
    <?php if(isset($errors['description'])){
      print("Error/n");
    } ?>
  </div>
  <div class="registration-form__container registration-form__container--subjects">
    <h4 class="registration-form__subjects-title">
      Предметы, с которыми Вы готовы помочь:
    </h4>
    <div>
      <?php foreach($subjects as $s): ?>
      <input type="checkbox" id="<?= $s['id'] ?>" name="<?= $s['id'] ?>" value="<?= $s['id'] ?>">
      <label for="<?= $s['id'] ?>"><?= $s['title'] ?></label>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="registration-form__container registration-form__container--subjects">
    <h4 class="registration-form__subjects-title">
      Предметы, в которых хотите разобраться:
    </h4>
    <div>
      <?php foreach($subjects as $s): ?>
        <input type="checkbox" id="<?= $s['id'] ?>" name="help_<?= $s['id'] ?>" value="<?= $s['id'] ?>">
        <label for="<?= $s['id'] ?>"><?= $s['title'] ?></label>
      <?php endforeach; ?>
    </div>
  </div>
  <input type="submit" value="Зарегистрироваться">
</form>
