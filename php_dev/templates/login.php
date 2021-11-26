<form class="registration-form" method="post" action="">
  <div class="registration-form__container">
    <label for="email">
      Ваш email
    </label>
    <input class="registration-form__input" type="email" name="email" id="email" value="<?= getPostVal('email') ?>">
    <?php if(isset($errors['email'])){
      print($errors['email']);
    } ?>
  </div>
  <label for="password">
    Ваш пароль:
  </label>
  <input class="registration-form__input" type="password" name="password" id="password" value="<?= getPostVal('password') ?>">
  <?php if(isset($errors['email'])){
    print($errors['email']);
  } ?>
  </div>
  <input type="submit" value="Войти">
</form>
