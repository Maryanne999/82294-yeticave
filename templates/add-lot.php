
   <nav class="nav">
    <ul class="nav__list container">
     <?php foreach ($categories as $key => $value) : ?>
      <li class="nav__item">
        <a href="all-lots.html"><?=$value;?></a>
      </li>
     <?php endforeach; ?>
    </ul>
  </nav>
  <form class="form form--add-lot container <?=count($errors) ? 'form--invalid' : '' ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=count($errors ['lot-name']) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$lot-name;?>" required>
        <span class="form__error"><?=$err_message[$key] ; ?></span>
      </div>
      <div class="form__item <?=count($errors ['category']) ? 'form__item--invalid' : '' ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
 <?php foreach ($categories as $key => $value) : ?>
                <option><?=$value;?></option>
               <?php endforeach; ?>
        </select>
        <span class="form__error"><?=$err_message ; ?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?=count($errors ['message']) ? 'form__item--invalid' : '' ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" value="<?=$message;?>" required></textarea>
      <span class="form__error"><?=$err_message[$key] ; ?></span>
    </div>
    <div class="form__item form__item--file <?=count($errors ['avatar']) ? 'form__item--uploaded' : '' ?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=$file_url;?>" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="avatar" id="photo2" value="<?=$avatar;?>">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=count($errors ['lot-rate']) ? 'form__item--invalid' : '' ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$lot-rate;?>" required>
        <span class="form__error"><?=$err_message[$key] ; ?></span>
      </div>
      <div class="form__item form__item--small <?=count($errors ['lot-step']) ? 'form__item--invalid' : '' ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$lot-step;?>" required>
        <span class="form__error"><?=$err_message[$key] ; ?></span>
      </div>
      <div class="form__item <?=count($errors ['lot-date']) ? 'form__item--invalid' : '' ?>">
        <label for="lot-date">Дата завершения</label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?=$lotDate;?>" required>
        <span class="form__error"><?=$err_message[$key] ; ?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom <?=count($errors) ? 'form--invalid' : '' ?>">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>