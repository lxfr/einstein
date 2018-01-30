# Полнотекстовый поиск через Elasticsearch + Yii2 с учетом морфологии и транслита

## Включает в себя:
Elasticsearch 5.4 + плагин "анализатор морфологии"
Yii 2 Base Project
Composer
Nginx
PHP 7
Postgres

## Для чего нужна?
Ищем только через ElasticSearch с учетом морфологии и транслита.
Если есть записи с текстом "у нас лучшие окна", запись будет найдена как по запросу "окно", так и по запросу "okno". База данных SQL при этом не пытается выстрелить себе в ногу и не участвует в поиске от слова "вообще" и подтягивается только в случае открытия документа уже из списка "найденных". То есть весь поиск только через Elasticsearch.

## Особенности:
* поиск производится в ElasticSearch через 1 индекс (индекс называется storage и "вшит в код" данной сборки, что не является хорошим случаем для разработки, но годно в качестве примера)
* при помощи Yii2 Gii был создан CRUD интерфейс для управления записями
* при создании/обновлении/удалении записей в CRUD, обновляется индекс в Elasticsearch, таким образом идет синхронизация с Elasticsearch
* для ElasticSearch подключен плагин "анализатор морфологии" от https://github.com/imotov/elasticsearch-analysis-morphology
* в Yii2 подключена библиотека транслита, что позволяет искать как "окна", так и "okna"
* данная сборка создана для ознакомления работы Yii2 + ElasticSearch и не претендует на эталон программного обеспечения. Используйте на свой страх и риск.

## Быстрый старт:
* git clone ...
* docker-compose up -d
* ждем пару минут, пока composer скачает все нужные библиотеки, проверить можно через docker logs einstein-composer, пока все установит
* когда все установлено, открываем http://127.0.0.1:5005 , это наш сайт
* доступ к postgres через http://127.0.0.1:5002 (adminer), выбираем postgres, user root, пароль 123, адрес - db, база данных - einstein
* создаем новые записи на сайте и ищем их через ElasticSearch прямо на главной странице.
* при наличии ошибок вроде "The directory is not writable by the Web process: /app/web/assets" ручками создаем их и пишем chmod 777 [наша_директория] -R
* таблицы базы данных импортируются автоматически при первом старте
* индекс/mapping в Elasticsearch создается автоматически, при создании первой записи в CRUD на сайте

## Интересные команды:
* docker-compose up -d
 - поднять проект
* docker-compose down
 - потушить проект
* docker logs einstein-composer
 - проверить логи composer-a
* curl 127.0.0.1:9200/storage/_search?pretty
 - показать все записи в индексе ElasticSearch
* curl -XDELETE http://127.0.0.1:9200/*
 - очистить индекс ElasticSearch

## Примечание
Если у вас есть желание помимо чистки индекса в ElasticSearch грохнуть все записи в базе, а также обнулить их autoincrement поля, можете в adminer'e дать sql команду:
TRUNCATE TABLE content;
TRUNCATE TABLE complex;
TRUNCATE TABLE knowledge;
ALTER sequence content_id_seq RESTART WITH 1;
ALTER sequence complex_id_seq RESTART WITH 1;
ALTER sequence knowledge_id_seq RESTART WITH 1;

## P.S. для работы требуются:
docker-ce
docker-compose (с поддержкой VERSION 3)
curl (для работы с CURL напрямую с ElasticSearch)
git

Сборка протестирована на OS Debian Linux.
PHP может отправлять письма через mail(), но это не важно и идет бонусом данной сборки.
