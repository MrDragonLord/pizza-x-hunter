# Установка Pizza x Hunter

## Минимальные системные требования

- **PHP**: 8.3
- **Node.js**: 18.20
- **NPM**: 10.3
- **MySQL**: 8

## Шаги установки

### 1. Настройка Pizza x Hunter

1. Склонируйте проект
    ```sh
    git clone https://github.com/MrDragonLord/pizza-x-hunter.git
    cd pizza-x-hunter
    ```

2. Настройте файл `.env` для подключения к базе данных:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

    TELEGRAM_BOT_TOKEN=your_telegram_bot_token
    ```

3. Сгенерируйте ключ приложения:
    ```sh
    php artisan key:generate
    ```

4. Сгенерируйте секретный ключ JWT:
    ```sh
    php artisan jwt:secret
    ```

5. Запустите миграции для создания таблиц в базе данных:
    ```sh
    php artisan migrate
    ```
6. Заполните базу данных
    ```sh
    php artisan db:seed
    ```

### 2. Установка зависимостей

1. Зависимости PHP
    ```sh
    composer install
    ```

2. Зависимости JavaScript
    ```sh
    npm install
    ```

### 3. Запуск проекта

1. Сборка JavaScript
    ```sh
    npm run npm
    ```

2. Запустите сервер разработки Laravel:
    ```sh
    php artisan serve
    ```
### 4. Запуск Telegram бота
1. Необходимо перейти по ссылке, важно, необходимо наличие SSL сертификата
    ```url
    https://example.ru/set-hook
    ```

Теперь проект Pizza x Hunter готов к использованию!
