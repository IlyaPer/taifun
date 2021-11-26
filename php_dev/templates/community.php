<section class="search">
  <h4 class="search__title">Фильтры поиска</h4>
  <div class="search__container">
    <div>
      <label for="region">
        Регион:
      </label>
      <input class="search__input search__input--region" type="text" placeholder="Страна, город или населнный пункт" name="region" id="region">
    </div>
    <div>
      <label for="age" class="search__age-title">
        Возраст:
      </label>
      <input class="search__input" type="number" placeholder="Возраст собеседника" name="age" id="age">
    </div>
    <input type="submit" value="Найти">
  </div>
</section>
<main class="people">
  <ul class="people__list">
    <?php
    foreach($users as $u):
      $url = "user.php?" . http_build_query(['id' => $u['id']]);
    ?>
    <li class="people__item">
      <a href="<?= $url; ?>" class="people__item">
        <img src="<?= $u['url']; ?>" class="people__photo" alt="<?= $u['name']; ?>">
        <div class="people__info-container">
          <h6 class="people__title"><?= $u['name']; ?></h6>
          <p class="people__age"><?= $u['age']; ?></p>
          <div>
            <button class="people__button">
              МАТЕМАТИКА
            </button>
            <button class="people__button">
              ФИЗИКА
            </button>
          </div>
          <p class="people__description"><?= $u['info']; ?></p>
          <div class="people__container">
          </div>
        </div>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
