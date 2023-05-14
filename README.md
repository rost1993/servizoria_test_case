# servizoria_test_case

Laravel v10.9.0 (PHP v8.1.6)

## Install project
php composer install

php artisan key:generate

php artisan migrate

npm install

nom run dev

## Авторизация по API проиходит по Bearer token

Регистрация на веб-ресурсе через графическую форму http://localhost/register

После регистрации пользователю будет создан уникальный Bearer Token, который можно посмотреть в разделе http://localhost/profile

В базе данных информация о курсе валют хранится относительно российского рубля.

Список доступных валют можно посмотреть отправив POST-запрос http://localhost/api/currency

Для получения курса валюты http://localhost/api/rate

Доступные параметры:

currency - валюта, которую необходимо запросить (например, USD)

date_start - дата с которой необходимо произвести выгрузку данных (например, 01.05.2023)

date_end - дата по которую необходимо произвести выгрузку данных (например, 14.05.2023)

currency_convert - валюта относительно которой необходимо произвести конвертацию (например, EUR). По умолчанию если параметр не передан считается относительно российского рубля

Пример POST-запроса (необходимо передать дополнительно заголовки для Bearer авторизации):

http://localhost/api/rate?currency=USD&date_start=01.05.2023&date_end=14.05.2023&currency_convert=INR