
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
      <div class="form__item <?=in_array('lot-name', $errors) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$lot_name;?>" required>
        <span class="form__error"><?=isset($err_messages['lot-name']) ? 'Введите название лота'  : ''; ?></span>
      </div>
      <div class="form__item <?=in_array('category', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
 <?php foreach ($categories as $key => $value) : ?>
                <option><?=$value;?></option>
               <?php endforeach; ?>
        </select>
        <span class="form__error"><?=isset($err_messages['category']) ? 'Выберите категорию'  : ''; ?></span>
      </div>
    </div>
    <div class="form__item form__item--wide <?=in_array('message', $errors) ? 'form__item--invalid' : '' ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$message;?></textarea>
      <span class="form__error"><?=isset($err_messages['message']) ? 'Добавьте описание'  : ''; ?></span>
    </div>
    <div class="form__item form__item--file <?=in_array('avatar', $errors) ? 'form__item--uploaded' : '' ?>"> <!-- form__item--uploaded -->
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
      <div class="form__item form__item--small <?=in_array('lot-rate', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$lot_rate;?>" required>
        <span class="form__error"><?=isset($err_messages['lot-rate']) ? 'Укажите начальную цену'  : ''; ?></span>
      </div>
      <div class="form__item form__item--small <?=in_array('lot-step', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$lot_step;?>" required>
        <span class="form__error"><?=isset($err_messages['lot-step']) ? 'Укажите шаг ставки'  : ''; ?></span>
      </div>
      <div class="form__item <?=in_array('lot-date', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="lot-date">Дата завершения</label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?=$lotDate;?>" required>
        <span class="form__error"><?=isset($err_messages['lot-date']) ? 'Добавьте завершения'  : ''; ?></span>
      </div>
    </div>
      <?php
      if (count($errors)): ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <?php endif; ?>
    <button type="submit" class="button">Добавить лот</button>
  </form>