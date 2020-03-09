# test-guide
#### Установка
Собрать проект на Symfony
```
git clone https://github.com/DonSlockZ/test-guide.git
cd test-guide/
```
В файле .env.local необходимо прописать свои настройки подключения к БД db_name
```
echo 'DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7' > .env.local
```
Установить зависимости и собрать билд
```
composer install
yarn install
yarn encore dev
```
Развернуть БД из дампа test_guide.sql.gz
```
gunzip < test_guide.sql.gz | mysql -u db_user db_name
```
Если дампа нет, выполнить миграции и фикстуры с тестовыми данными
```
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load --group=guide_group
```
Запустить веб-сервер, например nginx
> фронт контроллер можно найти в каталоге проекта ./public/index.php

Приложение справочника должно быть доступно по ссылке http://localhost/

#### Формат API
Взаимодействие с пользователем происходит посредством HTTP запросов к API серверу. Все ответы представляют собой JSON объекты.
Методы API доступны по маршруту http://localhost/api/.

- формат ответа об успешном выполнении запроса

Сопровождается полем "status" со значением "success". И данными в поле "data", которые в зависимости от запроса могут быть объектом или массивом
```
{
    "status": "success",
    "data": {"foo": "bar"}
}
```
- формат ответа с ошибкой
Поле "status" в значении "error". Сопровождается подробным сообщением об ошибке в поле "message". Такой ответ возникает в исключительных ситуциях, когда запрос составлен неверно(код 400) или внутренней ошибки(код 500).
```
{
    "status": "error",
    "message": "Error message"
}
```
> в ответах могут встречаться другие необязательные поля

#### Методы API
- список всех организаций, которые относятся к указанной рубрике
http://localhost/api/categories/{categoryId}/organizations

- выдача информации об организациях по их идентификаторам
http://localhost/api/categories/{categoryId}/organizations

- список всех организаций, которые относятся к указанной рубрике
http://localhost/api/organizations/{id}

- список категорий в виде дерева
http://localhost/api/top-categories

- список всех категорий одномерным массивом
http://localhost/api/categories

