## Installation
- Firstly, clone the project:

```shell
git clone https://github.com/AbdullajonSoliyevFergana/top_post.git
```


- In your terminal/cmd change your directory to project directory:

```shell
cd top_post
```


- While you are in root directory of the project you have to install all required packages:

```shell
composer install
```


- Copy _.env.example_ as _.env_:

```shell
cp .env.example .env
```


- In your _.env_ write your Database credentials:
  **Example:**

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=top_post
DB_USERNAME=root
DB_PASSWORD=password
```


- Generate key:

```shell
php artisan key:generate
```

- Clear cache:

```shell
php artisan optimize
```

- Connect db postgresql and run migrations:

```shell
php artisan migrate
```

- Run the project:

```shell
php artisan serve
```

- Show APIs with Postman Collection:

