<main class="person">
  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
  </script>
  <style>
    /* Dropdown Button */
    .person__dropbtn {
      background-color: #3498DB;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .person__dropbtn:hover, .dropbtn:focus {
      background-color: #2980B9;
    }

    /* Dropdown Content (Hidden by Default) */
    .person__dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {display:block;}
  </style>
  <div class="person__info-container">
    <img class="person__photo" src="<?= $user['url']; ?>" alt="<?= $user['name']; ?>">
    <div class="person__info">
      <h1><?= $user['name']; ?></h1>
      <h2><?= $user['age']; ?></h2>
      <p><?= $user['info']; ?></p>
      <?php if($my_account === 1): ?>
        <button onclick="myFunction()" class="person__dropbtn">Создать заявку</button>
          <form id="myDropdown" class="person__dropdown-content" action="application-add.php">
            <label for="title">Заголовок заявки</label>
            <input name="title" id="title" type="text" placeholder="Напишите с чем вы хотите получить помощь">
            <label for="content">Содержание заявки</label>
            <textarea name="content" id="content" placeholder="Напишите подробнее, что вы хотели бы узнать"></textarea>
            <label for="subject">Выбор предмета заявки</label>
            <select id="subject" name="subject">
              <?php foreach($subjects as $s): ?>
                <option value="<?= $s['id']; ?>"><?= $s['title']; ?></option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" id="user_id" name="user_id" value="<?= intval($user['id']) ?>">
            <input type="hidden" id="url" name="url" value="<?= $user['url'] ?>">
            <input type="submit" value="Опубликовать">
          </form>
      <?php else: ?>
        <a class="person__dropbtn" href="mailto:<?= $user['email']; ?>">Написать пользователю</a>
      <?php endif; ?>
    </div>
  </div>
  <section class="person__skills-info">
    <div class="person__skills-wrapper">
      <h2 class="person__skills-title">Владеет предметами:</h2>
      <ul class="person__list">
        <?php foreach($user_subjects as $subject): ?>
        <li class="person__skill">
            <?= $subject['title'] ?>
          <hr>
          <?php if($subject['text'] !== NULL or $my_account === 0): ?>
          <p><?= $subject['text'] ?></p>
          <?php else: ?>
          <form method="post" action="subject_info.php">
            <label for="<?= $subject['id'] ?>"></label>
            <textarea id="<?= $subject['id'] ?>" name="<?= $subject['id'] ?>" placeholder="Ваши навыки в данном предмете"></textarea>
            <input type="hidden" name="ids" id="ids" value="<?= $subject['id'] ?>">
            <input type="submit" value="СОХРАНИТЬ">
          </form>
          <?php endif; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h2 class="person__skills-title">Хочет разобраться в предметах:</h2>
      <ul class="person__list">
        <?php foreach($user_help_subjects as $help_subject): ?>
        <li class="person__skill">
          <?= $help_subject['title'] ?>
          <hr>
          <?php if($help_subject['text'] !== NULL or $my_account === 0): ?>
            <p><?= $help_subject['text'] ?></p>
          <?php else: ?>
          <form method="post" action="sub_info.php">
            <label for="<?= $help_subject['id'] ?>"></label>
            <textarea id="<?= $help_subject['id'] ?>" name="<?= $help_subject['id'] ?>" placeholder="Ваши навыки в данном предмете"></textarea>
            <input type="hidden" name="ids" id="ids" value="<?= $help_subject['id'] ?>">
            <input type="submit" value="СОХРАНИТЬ">
          </form>
          <?php endif; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
</main>
