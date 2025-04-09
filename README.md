# Гайд по установке

### Требования к ПО для работы
```
- PHP >= 8.3
- Redis
- PostgreSql
```

### Тех. стэк
#### Utilities
Postman, Swagger UI, PHPStan, PHPCS
#### DevOps
Git, GitHub, PHP Unit

### После клонирования репозитория необходимо выполнить следующие команды:
```bash
1 - cp .env.example .env
1.1 - настроить env (указать коннект к бд)

2 - php artisan key:generate

3 - php artisan migrate

4 - php artisan db:seed

4 - php artisan passport:keys

5 - php artisan passport:client --client
```

### Для запуска проекта:
```bash
php artisan serve
```

### Запустите очередь, что-бы данные изменялись
```bash
php artisan queue:work --sleep=2 --tries=3
```

### Для того что-бы увидеть какие эндпоинты зарезервированны:
```bash
php artisan route:list
```

### Сваггер документация:
```bash
your.domain.com/swagger/web (Апи документация)
your.domain.com/swagger/admin (Админ апи документация)
```