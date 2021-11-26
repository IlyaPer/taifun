<section class="search">
  <h4 class="search__title">Фильтры поиска</h4>
  <ul class="search__subjects-list">
    <?php foreach($subjects as $subject): ?>
    <li class="search__subject">
      <p class="search__subject-title"><?= $subject['title']; ?></p>
      <img class="search__subject-photo" src="<?= $subject['url']; ?>" alt="<?= $subject['title']; ?>">
    </li>
    <?php endforeach; ?>
  </ul>
  <div class="search__container">
    <div>
      <label class="search__label" for="region">
        Регион:
      </label>
      <input class="search__input search__input--region" type="text" placeholder="Страна, город или населнный пункт" name="region" id="region">
    </div>
    <input type="submit" value="Найти">
  </div>
</section>
<main class="people">
  <ul class="people__list">
    <?php
    foreach($applications as $app):
      $per_url = "user.php?" . http_build_query(["id" => $app['user_id']]);
      ?>
    <li class="people__item">
      <a href="<?= $per_url; ?>" class="people__item">
        <img src="<?= $app['url']; ?>" class="people__photo" alt="Имя человека">
        <div class="people__info-container">
          <h6 class="people__title"><?= $app['title']; ?></h6>
          <div class="people__location-container">
            <img class="people__location-icon" src="css/location.svg" alt="Местоположение">
            <h4 class="people__location-title">Москва</h4>
          </div>
          <div>
            <button class="people__button">
              <?= $app['main_title']; ?>
            </button>
          </div>
          <p class="people__description"><?= $app['content']; ?></p>
          <div class="people__container">
          </div>
        </div>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</main>
